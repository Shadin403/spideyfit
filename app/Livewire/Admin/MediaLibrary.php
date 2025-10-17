<?php

namespace App\Livewire\Admin;

use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
#[Title('Media Library')]
class MediaLibrary extends Component
{
    use WithFileUploads, WithPagination;

    public $files = [];
    public $search = '';
    public $filterType = 'all';
    public $viewMode = 'list'; // 'grid' or 'list'
    public $perPage = 20;
    public $selectedItems = [];
    public $selectAll = false;

    // For rename modal
    public $renamingMediaId = null;
    public $newFilename = '';

    // For preview modal
    public $previewMedia = null;

    // For URL import feature
    public $importUrl = '';
    public $isImporting = false;

    protected $paginationTheme = 'bootstrap';

    // Additional properties for premium UI
    public $sortBy = 'created_at';
    public $recentUploads = [];

    protected $queryString = ['search', 'filterType', 'viewMode', 'sortBy'];

    protected $listeners = ['fileUploaded' => '$refresh'];

    // Validation rules for URL import
    protected $rules = [
        'importUrl' => 'required|url',
    ];

    public function mount()
    {
        // Don't load recent uploads on mount - only show after actual uploads
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterType()
    {
        $this->resetPage();
    }

    public function updatedSortBy()
    {
        $this->resetPage();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedItems = $this->getMediaQuery()->get()->pluck('id')->toArray();
        } else {
            $this->selectedItems = [];
        }
    }

    public function updatedFiles()
    {
        $this->validate([
            'files' => 'required|array|max:100',
            'files.*' => 'required|file|mimes:jpg,jpeg,png,gif,webp,svg,mp4,avi,mov,wmv,flv,webm,mkv,m4v,3gp,3g2,ogv,pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048000',
        ]);


        $uploadedCount = count($this->files);
        foreach ($this->files as $file) {
            // Additional security check to prevent malicious files
            if ($this->isSuspiciousFile($file)) {
                $this->dispatch('show-error', 'File upload rejected: Suspicious file detected.');
                continue;
            }
            $this->uploadFile($file);
        }

        $this->files = [];

        // Load recent uploads only after successful upload
        $this->loadRecentUploads();

        $this->dispatch('fileUploaded');
        $this->dispatch('show-success', "Successfully uploaded {$uploadedCount} file(s)!");
    }

    protected function uploadFile($file)
    {
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename = pathinfo($originalName, PATHINFO_FILENAME);

        // Block dangerous file extensions
        $dangerousExtensions = ['php', 'php3', 'php4', 'php5', 'php7', 'phtml', 'phar', 'exe', 'bat', 'cmd', 'sh', 'pl', 'py', 'jsp', 'asp', 'aspx'];
        if (in_array(strtolower($extension), $dangerousExtensions)) {
            $this->dispatch('show-error', 'File type not allowed: ' . $extension);
            return;
        }

        // If we don't have a valid filename, provide a default
        if (empty($filename)) {
            $filename = 'uploaded-file-' . time();
        }

        $uniqueFilename = $filename . '-' . time() . '.' . $extension;

        // Limit filename length
        if (strlen($uniqueFilename) > 255) {
            $filename = substr($filename, 0, 200); // Leave room for timestamp and extension
            $uniqueFilename = $filename . '-' . time() . '.' . $extension;
        }

        // Store in storage/app/public/media (no subfolders)
        $path = $file->storeAs('media', $uniqueFilename, 'public');

        // Verify the stored file is not suspicious
        $storedFilePath = storage_path('app/public/' . $path);
        if (file_exists($storedFilePath)) {
            $fileContent = file_get_contents($storedFilePath, false, null, 0, 1024);
            if ($this->isSuspiciousFileContent($fileContent, $extension)) {
                // Delete the suspicious file
                unlink($storedFilePath);
                // Don't create database record
                $this->dispatch('show-error', 'Suspicious file content detected. Upload rejected.');
                return;
            }
        }

        Media::create([
            'user_id' => \Illuminate\Support\Facades\Auth::id(),
            'filename' => $originalName,
            'disk' => 'public',
            'path' => 'media/' . $uniqueFilename,
            'extension' => $extension,
            'mime' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);
    }

    // New method to import file from URL
    public function importFromUrl()
    {
        $this->validate([
            'importUrl' => 'required|url',
        ]);

        try {
            $this->isImporting = true;

            // Special handling for Facebook URLs
            $isFacebookUrl = strpos($this->importUrl, 'facebook.com/share/v/') !== false;

            // Check if this is a Facebook share URL and inform user
            if ($isFacebookUrl) {
                $this->dispatch('show-info', 'Facebook share URLs require special handling. Attempting to process...');
            }

            // Download the file from URL
            try {
                $response = Http::timeout(30)->get($this->importUrl);

                if ($response->failed()) {
                    $this->dispatch('show-error', 'Failed to download file from URL. Status code: ' . $response->status() . '. Response: ' . $response->body());
                    $this->isImporting = false;
                    return;
                }

                // Check if this is an HTML page (not a direct file)
                $contentType = $response->header('Content-Type', '');
                if (strpos($contentType, 'text/html') !== false && !$isFacebookUrl) {
                    $this->dispatch('show-error', 'URL points to a web page, not a direct file. Please provide a direct link to a file.');
                    $this->isImporting = false;
                    return;
                }

                // Special handling for Facebook URLs - check if we got HTML content
                if ($isFacebookUrl && strpos($contentType, 'text/html') !== false) {
                    $this->dispatch('show-error', 'Facebook share URLs point to web pages that cannot be directly downloaded. Please provide a direct link to a video file.');
                    $this->isImporting = false;
                    return;
                }
            } catch (\Exception $e) {
                $this->dispatch('show-error', 'Exception while downloading file from URL: ' . $e->getMessage());
                $this->isImporting = false;
                return;
            }

            // Get file content and headers
            $fileContent = $response->body();
            $contentType = $response->header('Content-Type', 'application/octet-stream');
            $contentLength = $response->header('Content-Length', strlen($fileContent));

            // Debug information
            $this->dispatch('show-info', 'File content length: ' . strlen($fileContent) . ' bytes, Content-Type: ' . $contentType);

            // Check file size (limit to 100MB)
            if (strlen($fileContent) > 100 * 1024 * 1024) {
                $this->dispatch('show-error', 'File is too large. Maximum size is 100MB.');
                $this->isImporting = false;
                return;
            }

            // Security check for suspicious content
            if ($this->isSuspiciousContent($fileContent, $this->importUrl)) {
                $this->dispatch('show-error', 'File import rejected: Suspicious content detected.');
                $this->isImporting = false;
                return;
            }

            // Extract filename from URL or headers
            $filename = $this->extractFilenameFromUrl($this->importUrl, $response);

            // Validate filename
            if (empty($filename)) {
                $this->dispatch('show-error', 'Could not determine filename from URL: ' . $this->importUrl);
                $this->isImporting = false;
                return;
            }

            // Generate unique filename
            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $filenameWithoutExt = pathinfo($filename, PATHINFO_FILENAME);
            $uniqueFilename = $filenameWithoutExt . '-' . time() . '.' . $extension;

            // Debug information
            $this->dispatch('show-info', 'Extracted filename: ' . $filename . ', extension: ' . $extension . ', unique filename: ' . $uniqueFilename);

            // Block dangerous file extensions
            $dangerousExtensions = ['php', 'php3', 'php4', 'php5', 'php7', 'phtml', 'phar', 'exe', 'bat', 'cmd', 'sh', 'pl', 'py', 'jsp', 'asp', 'aspx'];
            if (in_array(strtolower($extension), $dangerousExtensions)) {
                $this->dispatch('show-error', 'File type not allowed: ' . $extension);
                $this->isImporting = false;
                return;
            }

            // If we still don't have a valid extension, try to determine it from content type
            if (empty($extension)) {
                $extension = $this->getExtensionFromContentType($contentType);
                if (!empty($extension)) {
                    $filename = 'imported-file-' . time();
                    $uniqueFilename = $filename . '-' . time() . '.' . $extension;
                    $this->dispatch('show-info', 'Using content-type derived extension: ' . $extension . ', new filename: ' . $uniqueFilename);
                }
            }

            // Validate that we have a filename and extension
            if (empty($uniqueFilename)) {
                $this->dispatch('show-error', 'Invalid filename. Extracted filename: ' . $filename . ', extension: ' . $extension);
                $this->isImporting = false;
                return;
            }

            if (empty($extension)) {
                $this->dispatch('show-error', 'Invalid extension. Extracted filename: ' . $filename . ', unique filename: ' . $uniqueFilename);
                $this->isImporting = false;
                return;
            }

            // Check if media directory exists and is writable
            if (!Storage::disk('public')->exists('media')) {
                try {
                    Storage::disk('public')->makeDirectory('media');
                } catch (\Exception $e) {
                    $this->dispatch('show-error', 'Failed to create media directory: ' . $e->getMessage());
                    $this->isImporting = false;
                    return;
                }
            }

            // Test if we can write to the media directory
            try {
                $testFile = 'media/test-write-permission.tmp';
                Storage::disk('public')->put($testFile, 'test');
                Storage::disk('public')->delete($testFile);
            } catch (\Exception $e) {
                $this->dispatch('show-error', 'Media directory is not writable: ' . $e->getMessage());
                $this->isImporting = false;
                return;
            }

            // Store file in public storage
            $filePath = 'media/' . $uniqueFilename;

            // Check if file content is empty
            if (empty($fileContent)) {
                $this->dispatch('show-error', 'File content is empty. Cannot store empty file.');
                $this->isImporting = false;
                return;
            }

            try {
                $result = Storage::disk('public')->put($filePath, $fileContent);

                // Check if file was actually stored
                if (!$result) {
                    $this->dispatch('show-error', 'Failed to store file. Storage operation returned false.');
                    $this->isImporting = false;
                    return;
                }
            } catch (\Exception $e) {
                $this->dispatch('show-error', 'Failed to store file. Error: ' . $e->getMessage());
                $this->isImporting = false;
                return;
            }

            // Small delay to ensure file system completes write operation
            usleep(100000); // 0.1 second delay

            // Get the actual file size after storage with error handling
            $storedFileSize = 0;
            try {
                if (Storage::disk('public')->exists($filePath)) {
                    $storedFileSize = Storage::disk('public')->size($filePath);
                } else {
                    // Fallback to content length if file doesn't exist
                    $storedFileSize = strlen($fileContent);
                }
            } catch (\Exception $e) {
                // Fallback to content length if we can't get file size
                $storedFileSize = strlen($fileContent);
            }

            // Create media record
            Media::create([
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'filename' => $filename,
                'disk' => 'public',
                'path' => $filePath,
                'extension' => $extension,
                'mime' => $contentType,
                'size' => $storedFileSize,
            ]);

            // Clear the URL input
            $this->importUrl = '';

            // Load recent uploads
            $this->loadRecentUploads();

            $this->isImporting = false;

            $this->dispatch('fileUploaded');
            $this->dispatch('show-success', 'File successfully imported from URL!');
        } catch (\Exception $e) {
            $this->isImporting = false;
            $this->dispatch('show-error', 'Error importing file: ' . $e->getMessage());
        }
    }

    // Helper method to detect suspicious files
    private function isSuspiciousFile($file)
    {
        // Get file extension and MIME type
        $extension = strtolower($file->getClientOriginalExtension());
        $mimeType = $file->getMimeType();

        // Block dangerous file extensions
        $dangerousExtensions = ['php', 'php3', 'php4', 'php5', 'php7', 'phtml', 'phar', 'exe', 'bat', 'cmd', 'sh', 'pl', 'py', 'jsp', 'asp', 'aspx'];
        if (in_array($extension, $dangerousExtensions)) {
            return true;
        }

        // Read first few bytes of the file to check its actual content
        $fileContent = file_get_contents($file->getPathname(), false, null, 0, 1024);

        // Check for PHP tags in file content
        if (strpos($fileContent, '<?php') !== false || strpos($fileContent, '<?=') !== false) {
            return true;
        }

        // Check for JavaScript in files that shouldn't contain it
        $scriptExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv', 'm4v', '3gp', '3g2', 'ogv'];
        if (in_array($extension, $scriptExtensions) && (strpos($fileContent, '<script') !== false || strpos($fileContent, 'javascript:') !== false)) {
            return true;
        }

        // Check for HTML in video files
        if (in_array($extension, $scriptExtensions) && (strpos($fileContent, '<html') !== false || strpos($fileContent, '<!DOCTYPE') !== false)) {
            return true;
        }

        return false;
    }

    // Helper method to detect suspicious content in file content
    private function isSuspiciousFileContent($fileContent, $extension)
    {
        $extension = strtolower($extension);

        // Block dangerous file extensions
        $dangerousExtensions = ['php', 'php3', 'php4', 'php5', 'php7', 'phtml', 'phar', 'exe', 'bat', 'cmd', 'sh', 'pl', 'py', 'jsp', 'asp', 'aspx'];
        if (in_array($extension, $dangerousExtensions)) {
            return true;
        }

        // Check for PHP tags in file content
        if (strpos($fileContent, '<?php') !== false || strpos($fileContent, '<?=') !== false) {
            return true;
        }

        // Check for JavaScript in files that shouldn't contain it
        $scriptExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv', 'm4v', '3gp', '3g2', 'ogv'];
        if (in_array($extension, $scriptExtensions) && (strpos($fileContent, '<script') !== false || strpos($fileContent, 'javascript:') !== false)) {
            return true;
        }

        // Check for HTML in video files
        if (in_array($extension, $scriptExtensions) && (strpos($fileContent, '<html') !== false || strpos($fileContent, '<!DOCTYPE') !== false)) {
            return true;
        }

        return false;
    }

    // Helper method to detect suspicious content in imported files
    private function isSuspiciousContent($fileContent, $url)
    {
        // Extract extension from URL
        $parsedUrl = parse_url($url);
        $pathInfo = pathinfo($parsedUrl['path']);
        $extension = strtolower($pathInfo['extension'] ?? '');

        // Block dangerous file extensions
        $dangerousExtensions = ['php', 'php3', 'php4', 'php5', 'php7', 'phtml', 'phar', 'exe', 'bat', 'cmd', 'sh', 'pl', 'py', 'jsp', 'asp', 'aspx'];
        if (in_array($extension, $dangerousExtensions)) {
            return true;
        }

        // Check for PHP tags in file content
        if (strpos($fileContent, '<?php') !== false || strpos($fileContent, '<?=') !== false) {
            return true;
        }

        // Check for JavaScript in files that shouldn't contain it
        $scriptExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv', 'm4v', '3gp', '3g2', 'ogv'];
        if (in_array($extension, $scriptExtensions) && (strpos($fileContent, '<script') !== false || strpos($fileContent, 'javascript:') !== false)) {
            return true;
        }

        // Check for HTML in video files
        if (in_array($extension, $scriptExtensions) && (strpos($fileContent, '<html') !== false || strpos($fileContent, '<!DOCTYPE') !== false)) {
            return true;
        }

        return false;
    }

    // Helper method to extract filename from URL or headers
    private function extractFilenameFromUrl($url, $response)
    {
        // Special handling for Facebook URLs
        if (strpos($url, 'facebook.com/share/v/') !== false) {
            // Extract Facebook video ID
            $pathParts = explode('/', parse_url($url, PHP_URL_PATH));
            $videoId = end($pathParts);
            if (!empty($videoId)) {
                return 'facebook-video-' . $videoId;
            }
        }

        // Try to get filename from Content-Disposition header
        $contentDisposition = $response->header('Content-Disposition');
        if ($contentDisposition) {
            if (preg_match('/filename[^;=\n]*=(([\'"]).*?\2|[^;\n]*)/', $contentDisposition, $matches)) {
                $filename = trim($matches[1], '"\'');
                if ($filename) {
                    // Sanitize filename to prevent dangerous extensions
                    $filename = $this->sanitizeFilename($filename);
                    return $filename;
                }
            }
        }

        // Fallback to URL filename
        $parsedUrl = parse_url($url);
        $path = pathinfo($parsedUrl['path']);
        if (isset($path['filename']) && isset($path['extension'])) {
            $filename = $path['filename'] . '.' . $path['extension'];
            // Sanitize filename to prevent dangerous extensions
            $filename = $this->sanitizeFilename($filename);
            return $filename;
        } elseif (isset($path['filename'])) {
            $filename = $path['filename'];
            // Sanitize filename to prevent dangerous extensions
            $filename = $this->sanitizeFilename($filename);
            return $filename;
        }

        // Final fallback
        return 'imported-file-' . time();
    }

    // Helper method to sanitize filenames and prevent dangerous extensions
    private function sanitizeFilename($filename)
    {
        // Extract extension
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Block dangerous file extensions
        $dangerousExtensions = ['php', 'php3', 'php4', 'php5', 'php7', 'phtml', 'phar', 'exe', 'bat', 'cmd', 'sh', 'pl', 'py', 'jsp', 'asp', 'aspx'];
        if (in_array($extension, $dangerousExtensions)) {
            // Replace dangerous extension with .txt
            $filename = pathinfo($filename, PATHINFO_FILENAME) . '.txt';
        }

        // Remove any null bytes
        $filename = str_replace("\0", '', $filename);

        // Remove any directory traversal attempts
        $filename = str_replace(['../', '..\\', '..'], '', $filename);

        // Limit filename length
        if (strlen($filename) > 255) {
            $filename = substr($filename, 0, 255);
        }

        // If filename is empty or only extension, provide a default
        if (empty(pathinfo($filename, PATHINFO_FILENAME))) {
            $filename = 'imported-file-' . time() . (!empty($extension) ? '.' . $extension : '');
        }

        return $filename;
    }

    // Helper method to determine file extension from content type
    private function getExtensionFromContentType($contentType)
    {
        $mimeToExtension = [
            'image/jpeg' => 'jpg',
            'image/jpg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
            'image/svg+xml' => 'svg',
            'video/mp4' => 'mp4',
            'video/avi' => 'avi',
            'video/quicktime' => 'mov',
            'video/x-ms-wmv' => 'wmv',
            'video/x-flv' => 'flv',
            'video/webm' => 'webm',
            'video/x-matroska' => 'mkv',
            'application/pdf' => 'pdf',
            'text/plain' => 'txt',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/vnd.ms-excel' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'application/vnd.ms-powerpoint' => 'ppt',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
        ];

        return $mimeToExtension[strtolower($contentType)] ?? '';
    }

    public function toggleViewMode()
    {
        $this->viewMode = $this->viewMode === 'list' ? 'grid' : 'list';
    }

    public function openRenameModal($mediaId)
    {
        $media = Media::find($mediaId);
        if ($media) {
            $this->renamingMediaId = $mediaId;
            $this->newFilename = pathinfo($media->filename, PATHINFO_FILENAME);
            $this->dispatch('open-rename-modal');
        }
    }

    public function renameFile()
    {
        $this->validate([
            'newFilename' => 'required|string|max:255',
        ]);

        $media = Media::find($this->renamingMediaId);
        if ($media) {
            $newFilename = $this->newFilename . '.' . $media->extension;
            $media->update(['filename' => $newFilename]);

            $this->closeRenameModal();
            session()->flash('message', 'File renamed successfully!');
        }
    }

    public function closeRenameModal()
    {
        $this->renamingMediaId = null;
        $this->newFilename = '';
        $this->dispatch('close-rename-modal');
    }

    public function openPreview($mediaId)
    {
        $media = Media::find($mediaId);
        if ($media) {
            $this->previewMedia = $media;
        }
    }

    public function closePreview()
    {
        $this->previewMedia = null;
    }

    public function deleteSelected()
    {
        if (empty($this->selectedItems)) {
            $this->dispatch('show-error', 'No items selected!');
            return;
        }

        $media = Media::whereIn('id', $this->selectedItems)->get();

        foreach ($media as $item) {
            // Delete file from storage
            Storage::delete('public/' . $item->path);
            // Delete database record
            $item->delete();
        }

        $this->selectedItems = [];
        $this->selectAll = false;
        $this->dispatch('show-success', 'Selected files deleted successfully!');
    }

    public function deleteFile($mediaId)
    {
        $media = Media::find($mediaId);

        if ($media) {
            $filePath = $media->path;

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            $media->delete();
            $this->dispatch('show-success', 'File deleted successfully!');
        }
    }

    protected function getMediaQuery()
    {
        $query = Media::query();

        // Sorting
        switch ($this->sortBy) {
            case 'filename':
                $query->orderBy('filename', 'asc');
                break;
            case 'size':
                $query->orderBy('size', 'desc');
                break;
            case 'extension':
                $query->orderBy('extension', 'asc');
                break;
            case 'created_at':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Search
        if ($this->search) {
            $query->where('filename', 'like', '%' . $this->search . '%');
        }

        // Filter by type
        if ($this->filterType !== 'all') {
            switch ($this->filterType) {
                case 'image':
                    $query->whereIn('extension', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
                    break;
                case 'video':
                    $query->whereIn('extension', ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm']);
                    break;
                case 'pdf':
                    $query->where('extension', 'pdf');
                    break;
            }
        }

        return $query;
    }

    // Computed properties for premium UI
    public function getTotalMediaProperty()
    {
        return Media::count();
    }

    public function getTotalSizeProperty()
    {
        $totalBytes = Media::sum('size');
        return $this->formatBytes($totalBytes);
    }

    public function getImageCountProperty()
    {
        return Media::whereIn('extension', ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])->count();
    }

    public function getVideoCountProperty()
    {
        return Media::whereIn('extension', ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm'])->count();
    }

    // Additional methods for premium UI
    public function clearSelection()
    {
        $this->selectedItems = [];
        $this->selectAll = false;
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->filterType = 'all';
        $this->sortBy = 'created_at';
        $this->resetPage();
    }

    public function refreshLibrary()
    {
        $this->loadRecentUploads();
        $this->dispatch('refresh-complete');
    }

    public function clearRecentUploads()
    {
        $this->recentUploads = [];
    }

    protected function loadRecentUploads()
    {
        $recent = Media::latest()->limit(6)->get();

        $this->recentUploads = $recent->map(function ($media) {
            return [
                'id' => $media->id,
                'name' => $media->filename,
                'path' => $media->path,
                'type' => $media->mime,
                'extension' => $media->extension,
            ];
        })->toArray();
    }

    protected function formatBytes($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function render()
    {
        // Use Livewire's pagination - no need to call paginate() manually
        $media = $this->getMediaQuery()->paginate($this->perPage);

        return view('livewire.admin.media-library', [
            'media' => $media,
            'totalMedia' => $this->totalMedia,
            'totalSize' => $this->totalSize,
            'imageCount' => $this->imageCount,
            'videoCount' => $this->videoCount,
            'recentUploads' => $this->recentUploads,
        ]);
    }
}
