<div>
    <div class="media-library-container">
        <!-- Premium Header Section with Enhanced Design -->
        <div class="premium-header-section"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                              border-radius: 20px; margin-bottom: 32px; overflow: hidden; box-shadow: 0 10px 40px rgba(102, 126, 234, 0.2);">
            <div style="padding: 32px; color: white;">
                <div class="header-content"
                    style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
                    <div class="header-info">
                        <h1 class="main-title"
                            style="margin: 0 0 8px 0; font-size: 28px; font-weight: 700; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            Media Library
                        </h1>
                        <div class="breadcrumbs-premium"
                            style="display: flex; align-items: center; gap: 8px; font-size: 14px; opacity: 0.9;">
                            <a href="{{ route('admin.index') }}"
                                style="color: white; text-decoration: none; transition: opacity 0.2s ease;">
                                <i class="icon-home" style="margin-right: 4px;"></i>
                                Dashboard
                            </a>
                            <i class="icon-chevron-right" style="font-size: 12px;"></i>
                            <span style="opacity: 0.8;">Media Library</span>
                        </div>
                    </div>

                    <!-- Premium Action Buttons -->
                    <div class="premium-actions" style="display: flex; gap: 12px; align-items: center;">
                        <button class="premium-btn refresh-btn" wire:click="refreshLibrary"
                            style="display: flex; align-items: center; gap: 8px; padding: 12px 24px;
                               background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3);
                               border-radius: 50px; color: white; font-weight: 500; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                               backdrop-filter: blur(10px); position: relative; overflow: hidden;">
                            <i class="icon-refresh" style="font-size: 16px;"></i>
                            <span>Refresh</span>
                            <div class="btn-ripple"
                                style="position: absolute; top: 50%; left: 50%; width: 0; height: 0;
                                                       background: rgba(255,255,255,0.3); border-radius: 50%;
                                                       transform: translate(-50%, -50%); transition: width 0.6s, height 0.6s;">
                            </div>
                        </button>

                        <button class="premium-btn view-toggle-btn" wire:click="toggleViewMode"
                            style="display: flex; align-items: center; gap: 8px; padding: 12px 24px;
                               background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.4);
                               border-radius: 50px; color: white; font-weight: 600; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                               backdrop-filter: blur(10px); position: relative; overflow: hidden; min-width: 140px;">
                            @if ($viewMode === 'list')
                                <i class="icon-grid" style="font-size: 16px;"></i>
                                <span>Grid View</span>
                            @else
                                <i class="icon-list" style="font-size: 16px;"></i>
                                <span>List View</span>
                            @endif
                            <div class="btn-glow"
                                style="position: absolute; top: -2px; left: -2px; right: -2px; bottom: -2px;
                                                    background: linear-gradient(45deg, rgba(255,255,255,0.3), rgba(255,255,255,0.1));
                                                    border-radius: 50px; opacity: 0; transition: opacity 0.3s ease; z-index: -1;">
                            </div>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Decorative bottom wave -->
            <div class="header-wave"
                style="height: 60px; background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 1200 120">
                <path d="M0,60 Q300,20 600,60 T1200,60 L1200,120 L0,120 Z" fill="rgba(255,255,255,0.1)" /></svg>')
                no-repeat
                center bottom;
                background-size: cover; margin-top: -30px;">
            </div>
        </div>

        <!-- Stats Cards using theme grid system -->
        <div class="tf-section-4 mb-0">
            <div class="wg-chart-default">
                <div class="flex items-center gap12">
                    <div class="image">
                        <i class="icon-image"></i>
                    </div>
                    <div>
                        <div class="body-text">{{ number_format($totalMedia) }}</div>
                        <div class="text-tiny">Total Files</div>
                    </div>
                </div>
            </div>
            <div class="wg-chart-default">
                <div class="flex items-center gap12">
                    <div class="image">
                        <i class="icon-folder"></i>
                    </div>
                    <div>
                        <div class="body-text">{{ $totalSize }}</div>
                        <div class="text-tiny">Total Size</div>
                    </div>
                </div>
            </div>
            <div class="wg-chart-default">
                <div class="flex items-center gap12">
                    <div class="image">
                        <i class="icon-camera"></i>
                    </div>
                    <div>
                        <div class="body-text">{{ $imageCount }}</div>
                        <div class="text-tiny">Images</div>
                    </div>
                </div>
            </div>
            <div class="wg-chart-default">
                <div class="flex items-center gap12">
                    <div class="image">
                        <i class="icon-video"></i>
                    </div>
                    <div>
                        <div class="body-text">{{ $videoCount }}</div>
                        <div class="text-tiny">Videos</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 will handle notifications via JavaScript -->

    <!-- Enhanced Upload Area with proper file input handling -->
    <div class="upload-image mb-24" style="padding:10px;">
        <div class="wg-box" style="inline-size: 100%;">
            <div class="item up-load">
                <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true; progress = 0"
                    x-on:livewire-upload-finish="uploading = false; progress = 100"
                    x-on:livewire-upload-error="uploading = false; progress = 0"
                    x-on:livewire-upload-progress="progress = $event.detail.progress" class="uploadfile"
                    onclick="document.getElementById('file-upload').click()"
                    style="padding: 18px; border: 2px dashed #e2e8f0; border-radius: 12px; transition: all 0.3s ease;"
                    @dragover.prevent="event.dataTransfer.dropEffect = 'copy'; $el.classList.add('drag-over');"
                    @drop.prevent="window.handleFileDrop(event)" @dragenter.prevent="$el.classList.add('drag-over');"
                    @dragleave.prevent="$el.classList.remove('drag-over');">
                    <div class="icon mb-20">
                        <i class="icon-upload-cloud" style="font-size: 48px; color: #718096;"></i>
                    </div>
                    <h5 class="mb-15">Upload Files</h5>
                    <p class="mb-15">Drop files here or <span class="tf-color cursor-pointer">click
                            to upload</span></p>
                    <p class="text-muted fs-14 mb-20">Supports JPG, PNG, GIF, SVG, MP4, PDF and more (Max 15MB per file)
                    </p>

                    <div x-show="uploading" style="width: 25%">
                        <div class="progress" style="width: 100%;">
                            <div class="progress-bar" role="progressbar" :style="'width: ' + progress + '%'"
                                :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                                <span x-text="progress + '%'"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Uploads - Only show after upload -->
                    @if (!empty($recentUploads))
                        <div class="recent-uploads-preview"
                            style="border: 1px solid #e3e6f0; border-radius: 8px; padding: 16px; background: #f8f9fa; margin-top: 16px;">
                            <div class="d-flex align-items-center justify-content-between mb-12">
                                <div class="d-flex align-items-center gap-8">
                                    <i class="icon-check-circle text-success"></i>
                                    <span class="text-tiny fw-bold">Recent Uploads</span>
                                </div>
                                <button wire:click="clearRecentUploads" class="btn btn-sm btn-outline-secondary"
                                    title="Dismiss">
                                    <i class="icon-x"></i>
                                </button>
                            </div>
                            <div class="d-flex gap-8 justify-content-start flex-wrap">
                                @foreach (array_slice($recentUploads, 0, 6) as $upload)
                                    <div class="gallery-item style-recent" style="width: 80px; margin-bottom: 8px;">
                                        @if (str_contains($upload['type'], 'image'))
                                            <div class="image"
                                                style="width: 60px; height: 60px; margin: 0 auto 8px; border-radius: 6px; overflow: hidden;">
                                                <img src="{{ asset('storage/' . $upload['path']) }}"
                                                    alt="{{ $upload['name'] }}"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>
                                        @else
                                            <div class="image d-flex align-items-center justify-content-center bg-light"
                                                style="width: 60px; height: 60px; margin: 0 auto 8px; border-radius: 6px;">
                                                <i class="icon-file fs-5 text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="text-tiny text-center text-truncate"
                                            style="max-width: 75px; font-size: 10px;" title="{{ $upload['name'] }}">
                                            {{ $upload['name'] }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <input id="file-upload" type="file" wire:model="files" multiple
                        accept=".jpg,.jpeg,.png,.gif,.webp,.svg,.mp4,.avi,.mov,.wmv,.flv,.webm,.mkv,.m4v,.3gp,.3g2,.ogv,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"
                        style="display: none;">
                </div>
            </div>
        </div>
    </div>

    <!-- URL Import Section -->
    <div class="wg-box mb-24">
        <div class="p-24">
            <h5 class="mb-15">Import from URL</h5>
            <p class="text-muted fs-14 mb-20">Enter the URL of an image or video to download and import it to your
                media library.</p>

            <div class="d-flex gap-3">
                <div class="flex-grow-1">
                    <input type="url" wire:model="importUrl" placeholder="https://example.com/image.jpg"
                        class="form-control" style="border-radius: 12px; height: 45px;">
                </div>
                <button wire:click="importFromUrl" wire:loading.attr="disabled" class="tf-button style-1"
                    style="height: 45px;">
                    <span wire:loading.remove wire:target="importFromUrl">Import</span>
                    <span wire:loading wire:target="importFromUrl">
                        <i class="icon-loader"></i> Importing...
                    </span>
                </button>
            </div>

            @error('importUrl')
                <div class="text-danger mt-2 fs-14">{{ $message }}</div>
            @enderror

            <div class="mt-3">
                <small class="text-muted">
                    <i class="icon-info"></i> Supported formats: JPG, PNG, GIF, SVG, MP4, AVI, MOV, WMV, FLV, WEBM,
                    MKV, M4V, 3GP, 3G2, OGV, PDF and more.
                </small>
            </div>
        </div>
    </div>

    <!-- Enhanced Controls using theme classes -->
    <div class="wg-box mb-24">
        <div class="wg-filter p-24 border-bottom">
            <div class="flex justify-between items-center flex-wrap gap16">
                <div class="flex items-center gap16 flex-wrap">
                    <!-- Bulk Actions -->
                    @if (count($selectedItems) > 0)
                        <div class="flex items-center gap8">
                            <span class="text-tiny">{{ count($selectedItems) }} selected</span>
                            <button wire:click="clearSelection" class="tf-button-download">
                                <i class="icon-x"></i>
                            </button>
                        </div>
                    @endif

                    <!-- Per Page Selection -->
                    <div class="flex items-center gap8">
                        <span class="body-text">Show</span>
                        <div class="select w160">
                            <select wire:model.live="perPage">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                        <span class="body-text">entries</span>
                    </div>

                    <!-- Filter by Type -->
                    <div class="flex items-center gap8">
                        <span class="body-text">Filter:</span>
                        <div class="select w160">
                            <select wire:model.live="filterType">
                                <option value="all">All Files</option>
                                <option value="image">Images</option>
                                <option value="video">Videos</option>
                                <option value="pdf">PDFs</option>
                            </select>
                        </div>
                    </div>

                    <!-- Sort Options -->
                    <div class="flex items-center gap8">
                        <span class="body-text">Sort:</span>
                        <div class="select w160">
                            <select wire:model.live="sortBy">
                                <option value="created_at">Date Created</option>
                                <option value="filename">Filename</option>
                                <option value="size">Size</option>
                                <option value="extension">Type</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Search -->
                <div class="position-relative" style="width: 320px;">
                    <form class="form-search flex">
                        <input type="text" placeholder="Search files..." wire:model.live.debounce.300ms="search"
                            class="form-control" style="border-radius: 12px 0 0 12px; border-right: none;">
                        <div class="button-submit">
                            <button type="button" class="btn"
                                style="border-radius: 0 12px 12px 0; border-left: none; background: var(--Input); border-color: var(--Input);">
                                <i class="icon-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Loading Indicator -->
        {{-- <div wire:loading class="text-center p-30">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div> --}}

        @if ($viewMode === 'list')
            <!-- Premium Enhanced Table View -->
            <div class="premium-table-container"
                style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: none;">
                <div class="table-responsive">
                    <table class="premium-table"
                        style="width: 100%; border-collapse: separate; border-spacing: 0; border: none;">
                        <thead>
                            <tr class="premium-table-header"
                                style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
                                <th
                                    style="padding: 20px 16px; font-weight: 600; color: #475569; font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; border-right: 1px solid #e2e8f0;">
                                    #ID</th>
                                <th
                                    style="padding: 20px 16px; font-weight: 600; color: #475569; font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; border-right: 1px solid #e2e8f0;">
                                    Preview</th>
                                <th
                                    style="padding: 20px 16px; font-weight: 600; color: #475569; font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; border-right: 1px solid #e2e8f0;">
                                    Filename</th>
                                <th
                                    style="padding: 20px 16px; font-weight: 600; color: #475569; font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; border-right: 1px solid #e2e8f0;">
                                    Size</th>
                                <th
                                    style="padding: 20px 16px; font-weight: 600; color: #475569; font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; border-right: 1px solid #e2e8f0;">
                                    Type</th>
                                <th
                                    style="padding: 20px 16px; font-weight: 600; color: #475569; font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; border-right: 1px solid #e2e8f0;">
                                    Created</th>
                                <th
                                    style="padding: 20px 16px; font-weight: 600; color: #475569; font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0;">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($media as $item)
                                <tr class="premium-table-row"
                                    style="border-bottom: 1px solid #f1f5f9; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);"
                                    onmouseover="this.style.backgroundColor='#fafbfc'; this.style.transform='translateX(4px)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.05)';"
                                    onmouseout="this.style.backgroundColor='transparent'; this.style.transform='translateX(0)'; this.style.boxShadow='none';">

                                    <td style="padding: 18px 16px; font-weight: 500; color: #64748b; font-size: 14px;">
                                        {{ $item->id }}</td>

                                    <td class="pname" style="padding: 18px 16px;">
                                        @if (in_array($item->extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']))
                                            <div class="image" style="position: relative;">
                                                <img src="{{ asset('storage/' . $item->path) }}"
                                                    alt="{{ $item->filename }}"
                                                    style="width: 60px; height: 60px; object-fit: cover; border-radius: 12px; border: 2px solid #f1f5f9; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.1);"
                                                    onmouseover="this.style.transform='scale(1.05)'; this.style.borderColor='#667eea'; this.style.boxShadow='0 4px 16px rgba(102, 126, 234, 0.3)';"
                                                    onmouseout="this.style.transform='scale(1)'; this.style.borderColor='#f1f5f9'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)';">
                                            </div>
                                        @elseif($item->extension === 'pdf')
                                            <div class="image d-flex align-items-center justify-content-center"
                                                style="width: 60px; height: 60px; background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); border-radius: 12px; border: 2px solid #fecaca; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(254, 226, 226, 0.4);"
                                                onmouseover="this.style.transform='scale(1.05)'; this.style.background='linear-gradient(135deg, #dc2626 0%, #b91c1c 100%)'; this.style.boxShadow='0 4px 16px rgba(220, 38, 38, 0.3)';"
                                                onmouseout="this.style.transform='scale(1)'; this.style.background='linear-gradient(135deg, #fee2e2 0%, #fecaca 100%)'; this.style.boxShadow='0 2px 8px rgba(254, 226, 226, 0.4)';">
                                                <i class="icon-file-text fs-4 text-danger"
                                                    style="transition: color 0.3s ease;"
                                                    onmouseover="this.style.color='white';"
                                                    onmouseout="this.style.color='#dc2626';"></i>
                                            </div>
                                        @elseif(in_array($item->extension, ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm']))
                                            <div class="image d-flex align-items-center justify-content-center"
                                                style="width: 60px; height: 60px; background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); border-radius: 12px; border: 2px solid #bfdbfe; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(219, 234, 254, 0.4); position: relative;"
                                                onmouseover="this.style.transform='scale(1.05)'; this.style.background='linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%)'; this.style.boxShadow='0 4px 16px rgba(37, 99, 235, 0.3)';"
                                                onmouseout="this.style.transform='scale(1)'; this.style.background='linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%)'; this.style.boxShadow='0 2px 8px rgba(219, 234, 254, 0.4)';">
                                                <i class="icon-video fs-4 text-primary"
                                                    style="transition: color 0.3s ease;"
                                                    onmouseover="this.style.color='white';"
                                                    onmouseout="this.style.color='#2563eb';"></i>
                                                <div style="position: absolute; bottom: 4px; right: 4px; width: 16px; height: 16px; background: rgba(37, 99, 235, 0.9); border-radius: 50%; display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease;"
                                                    onmouseover="this.style.opacity='1';"
                                                    onmouseout="this.style.opacity='0';">
                                                    <i class="icon-play" style="font-size: 8px; color: white;"></i>
                                                </div>
                                            </div>
                                        @else
                                            <div class="image d-flex align-items-center justify-content-center"
                                                style="width: 60px; height: 60px; background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%); border-radius: 12px; border: 2px solid #e2e8f0; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(241, 245, 249, 0.4);"
                                                onmouseover="this.style.transform='scale(1.05)'; this.style.background='linear-gradient(135deg, #64748b 0%, #475569 100%)'; this.style.boxShadow='0 4px 16px rgba(100, 116, 139, 0.3)';"
                                                onmouseout="this.style.transform='scale(1)'; this.style.background='linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%)'; this.style.boxShadow='0 2px 8px rgba(241, 245, 249, 0.4)';">
                                                <i class="icon-file fs-4 text-muted"
                                                    style="transition: color 0.3s ease;"
                                                    onmouseover="this.style.color='white';"
                                                    onmouseout="this.style.color='#64748b';"></i>
                                            </div>
                                        @endif
                                    </td>

                                    <td style="padding: 18px 16px;">
                                        <div class="name">
                                            <a href="#" class="body-title-2"
                                                style="font-weight: 600; color: #1e293b; text-decoration: none; transition: color 0.2s ease; display: block; margin-bottom: 4px;"
                                                onmouseover="this.style.color='#667eea';"
                                                onmouseout="this.style.color='#1e293b';">
                                                {{ $item->filename }}
                                            </a>
                                            @if ($item->extension === 'pdf')
                                                <small>
                                                    <a href="{{ asset('storage/' . $item->path) }}" target="_blank"
                                                        class="text-primary"
                                                        style="color: #667eea; text-decoration: none; font-weight: 500; transition: all 0.2s ease;"
                                                        onmouseover="this.style.color='#5a67d8'; this.style.textDecoration='underline';"
                                                        onmouseout="this.style.color='#667eea'; this.style.textDecoration='none';">
                                                        <i class="icon-external-link"
                                                            style="margin-right: 4px; font-size: 12px;"></i>View PDF
                                                    </a>
                                                </small>
                                            @endif
                                            @if ($item->dimensions ?? false)
                                                <small
                                                    style="display: block; color: #94a3b8; font-size: 11px; margin-top: 2px;">
                                                    <i class="icon-ruler"
                                                        style="margin-right: 4px;"></i>{{ $item->dimensions }}
                                                </small>
                                            @endif
                                        </div>
                                    </td>

                                    <td style="padding: 18px 16px;">
                                        <span
                                            style="font-weight: 500; color: #475569; font-size: 14px;">{{ $item->human_readable_size }}</span>
                                    </td>

                                    <td style="padding: 18px 16px;">
                                        <span class="badge"
                                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);">
                                            {{ strtoupper($item->extension) }}
                                        </span>
                                    </td>

                                    <td style="padding: 18px 16px;">
                                        <div style="font-weight: 500; color: #1e293b; font-size: 13px;">
                                            {{ $item->created_at->format('M j, Y') }}</div>
                                        <small
                                            style="color: #94a3b8; font-size: 11px;">{{ $item->created_at->diffForHumans() }}</small>
                                    </td>

                                    <td style="padding: 18px 16px;">
                                        <div class="list-icon-function"
                                            style="display: flex; gap: 8px; align-items: center;">
                                            @if (in_array($item->extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'mp4', 'avi', 'mov', 'wmv', 'flv', 'webm']))
                                                <button wire:click="openPreview({{ $item->id }})"
                                                    class="item premium-action-btn" title="Preview"
                                                    style="width: 36px; height: 36px; border: none; background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%); color: #64748b; border-radius: 10px; display: flex; align-items: center; justify-content: center; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); font-size: 14px;"
                                                    onmouseover="this.style.background='linear-gradient(135deg, #667eea 0%, #764ba2 100%)'; this.style.color='white'; this.style.transform='scale(1.1)'; this.style.boxShadow='0 4px 12px rgba(102, 126, 234, 0.4)';"
                                                    onmouseout="this.style.background='linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%)'; this.style.color='#64748b'; this.style.transform='scale(1)'; this.style.boxShadow='none';">
                                                    <i class="icon-eye"></i>
                                                </button>
                                            @endif
                                            <button wire:click="openRenameModal({{ $item->id }})"
                                                class="item edit premium-action-btn" title="Rename"
                                                style="width: 36px; height: 36px; border: none; background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%); color: #64748b; border-radius: 10px; display: flex; align-items: center; justify-content: center; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); font-size: 14px;"
                                                onmouseover="this.style.background='linear-gradient(135deg, #10b981 0%, #059669 100%)'; this.style.color='white'; this.style.transform='scale(1.1)'; this.style.boxShadow='0 4px 12px rgba(16, 185, 129, 0.4)';"
                                                onmouseout="this.style.background='linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%)'; this.style.color='#64748b'; this.style.transform='scale(1)'; this.style.boxShadow='none';">
                                                <i class="icon-edit-3"></i>
                                            </button>
                                            <button wire:click="deleteFile({{ $item->id }})"
                                                class="item text-danger delete premium-action-btn" title="Delete"
                                                style="width: 36px; height: 36px; border: none; background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%); color: #64748b; border-radius: 10px; display: flex; align-items: center; justify-content: center; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); font-size: 14px;"
                                                onmouseover="this.style.background='linear-gradient(135deg, #ef4444 0%, #dc2626 100%)'; this.style.color='white'; this.style.transform='scale(1.1)'; this.style.boxShadow='0 4px 12px rgba(239, 68, 68, 0.4)';"
                                                onmouseout="this.style.background='linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%)'; this.style.color='#64748b'; this.style.transform='scale(1)'; this.style.boxShadow='none';"
                                                wire:confirm="Are you sure you want to delete this file?">
                                                <i class="icon-trash-2"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-50">
                                        <div class="empty-state">
                                            <div class="empty-icon mb-20">
                                                <i class="icon-folder-open fs-1"></i>
                                            </div>
                                            <h4 class="mb-12">No files found</h4>
                                            @if ($search || $filterType !== 'all')
                                                <p class="text-muted mb-20">Try adjusting your search or filter
                                                    criteria</p>
                                                <button wire:click="clearFilters" class="tf-button style-2">
                                                    <i class="icon-refresh"></i>
                                                    <span>Clear Filters</span>
                                                </button>
                                            @else
                                                <p class="text-muted mb-20">Start by uploading some files to your media
                                                    library</p>
                                                <label for="file-upload" class="tf-button style-1">
                                                    <i class="icon-upload-cloud"></i>
                                                    <span>Upload Files</span>
                                                </label>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="divider"></div>
                <div class="flex flex-wrap items-center justify-between gap10 wgp-pagination">
                    {{ $media->links() }}
                </div>
            </div>
        @else
            <!-- Premium Grid View -->
            <div class="premium-grid-container" style="padding: 30px;">
                @if ($media->count() > 0)
                    <!-- Grid Header with View Options -->
                    <div class="grid-header mb-25"
                        style="display: flex; justify-content: between; align-items: center; margin-bottom: 25px;">
                        <div class="grid-info">
                            <h5 class="mb-8" style="margin: 0; color: #2d3748; font-weight: 600;">
                                Media Files ({{ $media->total() }})
                            </h5>
                            <p class="text-muted" style="margin: 0; font-size: 14px; color: #718096;">
                                Showing {{ $media->count() }} of {{ $media->total() }} files
                            </p>
                        </div>
                        <div class="view-controls" style="display: flex; gap: 8px;">
                            <button class="view-btn active"
                                style="padding: 8px 12px; border: 1px solid #e2e8f0; background: #667eea; color: white; border-radius: 8px; font-size: 12px;">
                                <i class="icon-grid"></i> Grid
                            </button>
                            <button class="view-btn" wire:click="toggleViewMode"
                                style="padding: 8px 12px; border: 1px solid #e2e8f0; background: white; color: #4a5568; border-radius: 8px; font-size: 12px;">
                                <i class="icon-list"></i> List
                            </button>
                        </div>
                    </div>

                    <!-- Premium Grid Layout -->
                    <div class="premium-grid-gallery">
                        <div class="grid-wrapper">
                            <div class="masonry-grid" id="masonry-grid"
                                style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 28px; padding: 10px;">

                                @foreach ($media as $item)
                                    <div class="premium-media-card" wire:key="media-grid-{{ $item->id }}"
                                        style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08);
                                               transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); position: relative; cursor: pointer;">

                                        <!-- Card Header with Image/Video -->
                                        <div class="card-media-container"
                                            style="position: relative; aspect-ratio: 16/10; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); overflow: hidden;">

                                            @if (in_array($item->extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']))
                                                <!-- Premium Image Display -->
                                                <div class="image-wrapper"
                                                    style="width: 100%; height: 100%; position: relative;">
                                                    <img src="{{ asset('storage/' . $item->path) }}"
                                                        alt="{{ $item->filename }}" class="premium-image"
                                                        style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;"
                                                        loading="lazy">
                                                    <!-- Image Overlay Effect -->
                                                    <div class="image-overlay"
                                                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                                                               background: linear-gradient(45deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
                                                               opacity: 0; transition: opacity 0.3s ease;">
                                                    </div>
                                                </div>
                                            @elseif($item->extension === 'pdf')
                                                <!-- Premium PDF Display -->
                                                <div class="file-display pdf-display"
                                                    style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;
                                                           background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); position: relative;">
                                                    <div class="file-icon-container" style="text-align: center;">
                                                        <i class="icon-file-text"
                                                            style="font-size: 64px; color: #dc2626; margin-bottom: 12px;"></i>
                                                        <div class="file-type-badge"
                                                            style="background: #dc2626; color: white; padding: 4px 12px; border-radius: 20px; font-size: 10px; font-weight: 600;">
                                                            PDF
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif(in_array($item->extension, ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv', 'm4v', '3gp', '3g2', 'ogv']))
                                                <!-- Premium Video Display -->
                                                <div class="file-display video-display"
                                                    style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;
                                                           background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); position: relative;">
                                                    <div class="video-icon-container" style="text-align: center;">
                                                        <div class="video-icon-wrapper"
                                                            style="position: relative; margin-bottom: 12px;">
                                                            <i class="icon-video"
                                                                style="font-size: 64px; color: #2563eb; margin-bottom: 12px;"></i>
                                                            <div class="play-button-overlay"
                                                                style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
                                                                       width: 40px; height: 40px; background: rgba(37, 99, 235, 0.9);
                                                                       border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                                <i class="icon-play"
                                                                    style="font-size: 16px; color: white;"></i>
                                                            </div>
                                                        </div>
                                                        <div class="file-type-badge"
                                                            style="background: #2563eb; color: white; padding: 4px 12px; border-radius: 20px; font-size: 10px; font-weight: 600;">
                                                            VIDEO
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <!-- Premium Generic File Display -->
                                                <div class="file-display generic-display"
                                                    style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;
                                                           background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%); position: relative;">
                                                    <div class="file-icon-container" style="text-align: center;">
                                                        <i class="icon-file"
                                                            style="font-size: 64px; color: #64748b; margin-bottom: 12px;"></i>
                                                        <div class="file-type-badge"
                                                            style="background: #64748b; color: white; padding: 4px 12px; border-radius: 20px; font-size: 10px; font-weight: 600;">
                                                            {{ strtoupper($item->extension) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Selection Checkbox -->
                                            <div class="selection-overlay"
                                                style="position: absolute; top: 12px; left: 12px; opacity: 0; transition: all 0.3s ease; z-index: 10;">
                                                <input type="checkbox" wire:model.live="selectedItems"
                                                    value="{{ $item->id }}" class="premium-checkbox"
                                                    style="width: 20px; height: 20px; border-radius: 6px; border: 2px solid #e2e8f0; background: white; cursor: pointer;">
                                            </div>

                                            <!-- Premium Actions Menu -->
                                            <div class="premium-actions-menu"
                                                style="position: absolute; top: 12px; right: 12px; opacity: 0; transform: translateY(-10px);
                                                       transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); z-index: 10;">
                                                <div class="actions-container" style="display: flex; gap: 6px;">
                                                    @if (in_array($item->extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'mp4', 'avi', 'mov', 'wmv', 'flv', 'webm']))
                                                        <button wire:click="openPreview({{ $item->id }})"
                                                            class="premium-action-btn preview-btn" title="Preview"
                                                            style="width: 36px; height: 36px; background: rgba(255,255,255,0.95);
                                                                   border: none; border-radius: 10px; display: flex; align-items: center; justify-content: center;
                                                                   color: #4a5568; font-size: 14px; transition: all 0.2s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                                            <i class="icon-eye"></i>
                                                        </button>
                                                    @endif
                                                    <button wire:click="openRenameModal({{ $item->id }})"
                                                        class="premium-action-btn edit-btn" title="Rename"
                                                        style="width: 36px; height: 36px; background: rgba(255,255,255,0.95);
                                                               border: none; border-radius: 10px; display: flex; align-items: center; justify-content: center;
                                                               color: #4a5568; font-size: 14px; transition: all 0.2s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                                        <i class="icon-edit"></i>
                                                    </button>
                                                    <button wire:click="deleteFile({{ $item->id }})"
                                                        wire:confirm="Are you sure you want to delete this file?"
                                                        class="premium-action-btn delete-btn" title="Delete"
                                                        style="width: 36px; height: 36px; background: rgba(255,255,255,0.95);
                                                               border: none; border-radius: 10px; display: flex; align-items: center; justify-content: center;
                                                               color: #e53e3e; font-size: 14px; transition: all 0.2s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                                        <i class="icon-trash-2"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- File Type Badge -->
                                            <div class="file-type-indicator"
                                                style="position: absolute; bottom: 12px; right: 12px; z-index: 5;">
                                                <span class="type-badge"
                                                    style="background: rgba(255,255,255,0.9); color: #4a5568; padding: 4px 10px;
                                                           border-radius: 20px; font-size: 10px; font-weight: 600; text-transform: uppercase;
                                                           box-shadow: 0 2px 8px rgba(0,0,0,0.1); backdrop-filter: blur(10px);">
                                                    {{ strtoupper($item->extension) }}
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Premium Card Content -->
                                        <div class="card-content" style="padding: 20px;">
                                            <!-- File Name and Size -->
                                            <div class="file-header" style="margin-bottom: 16px;">
                                                <h6 class="file-title"
                                                    style="font-size: 15px; font-weight: 600; color: #2d3748; margin: 0 0 8px 0;
                                                           line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"
                                                    title="{{ $item->filename }}">
                                                    {{ $item->filename }}
                                                </h6>
                                                <div class="file-meta-info"
                                                    style="display: flex; align-items: center; justify-content: space-between;">
                                                    <span class="file-size"
                                                        style="font-size: 12px; color: #718096; font-weight: 500;">
                                                        {{ $item->human_readable_size }}
                                                    </span>
                                                    @if ($item->dimensions ?? false)
                                                        <span class="file-dimensions"
                                                            style="font-size: 11px; color: #a0aec0; background: #f7fafc; padding: 2px 8px; border-radius: 12px;">
                                                            {{ $item->dimensions }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- File Date and Actions -->
                                            <div class="file-footer"
                                                style="display: flex; align-items: center; justify-content: space-between; padding-top: 12px; border-top: 1px solid #f1f5f9;">
                                                <div class="file-date">
                                                    <span style="font-size: 11px; color: #a0aec0;">
                                                        {{ $item->created_at->format('M j, Y') }}
                                                    </span>
                                                    <small style="display: block; font-size: 10px; color: #cbd5e0;">
                                                        {{ $item->created_at->diffForHumans() }}
                                                    </small>
                                                </div>

                                                <!-- Quick Actions -->
                                                <div class="quick-actions" style="display: flex; gap: 4px;">
                                                    @if (in_array($item->extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'mp4', 'avi', 'mov', 'wmv', 'flv', 'webm']))
                                                        <button wire:click="openPreview({{ $item->id }})"
                                                            class="quick-action-btn"
                                                            style="width: 28px; height: 28px; border: none; background: #f7fafc; color: #4a5568;
                                                                   border-radius: 6px; display: flex; align-items: center; justify-content: center;
                                                                   font-size: 12px; transition: all 0.2s ease;">
                                                            <i class="icon-eye"></i>
                                                        </button>
                                                    @endif
                                                    <button wire:click="deleteFile({{ $item->id }})"
                                                        wire:confirm="Are you sure you want to delete this file?"
                                                        class="quick-action-btn delete"
                                                        style="width: 28px; height: 28px; border: none; background: #fed7d7; color: #e53e3e;
                                                               border-radius: 6px; display: flex; align-items: center; justify-content: center;
                                                               font-size: 12px; transition: all 0.2s ease;">
                                                        <i class="icon-trash-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Grid View Pagination -->
                    <div class="grid-pagination"
                        style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #f1f5f9;">
                        <div style="display: flex; justify-content: between; align-items: center;">
                            <div class="pagination-info" style="color: #718096; font-size: 14px;">
                                Showing {{ $media->firstItem() ?? 0 }} to {{ $media->lastItem() ?? 0 }} of
                                {{ $media->total() }} entries
                            </div>
                            <div class="pagination-links">
                                {{ $media->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Enhanced Empty State for Grid View -->
                    <div class="empty-grid-state" style="text-align: center; padding: 80px 40px;">
                        <div class="empty-icon-container" style="margin-bottom: 32px;">
                            <div
                                style="width: 120px; height: 120px; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
                                       border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;
                                       box-shadow: 0 20px 40px rgba(0,0,0,0.05);">
                                <i class="icon-folder-open" style="font-size: 48px; color: #cbd5e0;"></i>
                            </div>
                            <h3 style="color: #2d3748; margin-bottom: 12px; font-weight: 600;">No files found</h3>
                            <p
                                style="color: #718096; margin-bottom: 32px; font-size: 16px; max-width: 400px; margin-left: auto; margin-right: auto;">
                                @if ($search || $filterType !== 'all')
                                    Try adjusting your search or filter criteria to find what you're looking for.
                                @else
                                    Start building your media library by uploading some files.
                                @endif
                            </p>
                            <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
                                @if ($search || $filterType !== 'all')
                                    <button wire:click="clearFilters" class="tf-button style-2"
                                        style="display: flex; align-items: center; gap: 8px;">
                                        <i class="icon-refresh"></i>
                                        <span>Clear Filters</span>
                                    </button>
                                @else
                                    <label for="file-upload" class="tf-button style-1"
                                        style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                        <i class="icon-upload-cloud"></i>
                                        <span>Upload Files</span>
                                    </label>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif


    </div>

    <!-- Delete Selected Button -->
    @if (count($selectedItems) > 0)
        <div class="position-fixed bottom-0 end-0 m-4">
            <button wire:click="deleteSelected"
                wire:confirm="Are you sure you want to delete {{ count($selectedItems) }} selected files?"
                class="tf-button style-1 bg-danger">
                <i class="icon-trash-2"></i> Delete ({{ count($selectedItems) }})
            </button>
        </div>
    @endif

    <!-- Enhanced Premium Rename Modal -->
    @if ($renamingMediaId)
        <div class="modal-backdrop-enhanced" id="rename-modal-backdrop"
            style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6);
                    backdrop-filter: blur(8px); z-index: 1050; display: flex; align-items: center; justify-content: center;
                    animation: fadeInBackdrop 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">

            <div class="modal-dialog-enhanced"
                style="max-width: 500px; width: 90%; margin: auto; position: relative;
                       animation: slideInModal 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);">

                <!-- Premium Modal Card -->
                <div class="premium-modal-card"
                    style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 25px 80px rgba(0,0,0,0.15);">

                    <!-- Enhanced Modal Header -->
                    <div class="modal-header-enhanced"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                               color: white; padding: 24px 32px; position: relative;">

                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div
                                style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                                <i class="icon-edit-3" style="font-size: 20px; color: white;"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0; font-size: 20px; font-weight: 600;">Rename File</h4>
                                <p style="margin: 4px 0 0 0; opacity: 0.9; font-size: 14px;">Update the filename while
                                    preserving the extension</p>
                            </div>
                        </div>

                        <button type="button" class="btn-close-enhanced" wire:click="closeRenameModal"
                            style="position: absolute; top: 20px; right: 20px; width: 32px; height: 32px;
                                   background: rgba(255,255,255,0.2); border: none; border-radius: 50%;
                                   color: white; display: flex; align-items: center; justify-content: center;
                                   transition: all 0.3s ease; cursor: pointer;">
                            <i class="icon-x" style="font-size: 16px;"></i>
                        </button>
                    </div>

                    <!-- Enhanced Modal Body -->
                    <div class="modal-body-enhanced" style="padding: 32px;">
                        <div class="form-group-enhanced" style="margin-bottom: 24px;">
                            <label class="form-label-enhanced"
                                style="display: block; margin-bottom: 8px; font-weight: 600; color: #2d3748; font-size: 14px;">
                                New Filename
                            </label>
                            <input type="text" wire:model="newFilename" class="form-control-enhanced"
                                placeholder="Enter new filename"
                                style="width: 100%; padding: 14px 16px; border: 2px solid #e2e8f0; border-radius: 12px;
                                       font-size: 14px; transition: all 0.3s ease; background: #f8fafc;">
                            <div class="form-text-enhanced"
                                style="margin-top: 6px; font-size: 12px; color: #718096; display: flex; align-items: center; gap: 4px;">
                                <i class="icon-info" style="font-size: 14px;"></i>
                                Extension will be preserved automatically
                            </div>
                        </div>

                        <!-- Preview Section -->
                        <div class="filename-preview"
                            style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                            <div style="font-size: 12px; color: #64748b; margin-bottom: 8px; font-weight: 500;">PREVIEW
                            </div>
                            <div
                                style="font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace; font-size: 13px; color: #2d3748; word-break: break-all;">
                                @if ($newFilename)
                                    <span style="color: #667eea; font-weight: 600;">{{ $newFilename }}</span><span
                                        style="color: #94a3b8;">.{{ $renamingMedia ? $renamingMedia->extension : '' }}</span>
                                @else
                                    <span style="color: #cbd5e0; font-style: italic;">Enter a new filename to see
                                        preview...</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Enhanced Modal Footer -->
                    <div class="modal-footer-enhanced"
                        style="padding: 24px 32px; background: #f8fafc; border-top: 1px solid #f1f5f9; display: flex; gap: 12px; justify-content: flex-end;">
                        <button type="button" class="btn-cancel-enhanced" wire:click="closeRenameModal"
                            style="padding: 12px 24px; background: white; border: 2px solid #e2e8f0; color: #64748b;
                                   border-radius: 12px; font-weight: 500; transition: all 0.3s ease; cursor: pointer;">
                            Cancel
                        </button>
                        <button type="button" class="btn-rename-enhanced" wire:click="renameFile"
                            style="padding: 12px 24px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                   color: white; border: none; border-radius: 12px; font-weight: 600;
                                   transition: all 0.3s ease; cursor: pointer; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);">
                            <i class="icon-check" style="margin-right: 8px; font-size: 14px;"></i>
                            Rename File
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Enhanced Premium Preview Modal -->
    @if ($previewMedia)
        <div class="modal-backdrop-premium" id="preview-modal-backdrop" wire:click="closePreview"
            style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9);
                    backdrop-filter: blur(8px); z-index: 1055; display: flex; align-items: center; justify-content: center;
                    animation: fadeInBackdrop 0.3s ease-out;">

            <div class="modal-dialog-premium"
                style="max-width: 90vw; max-height: 90vh; margin: auto;
                                                      animation: slideInModal 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);">

                <!-- Premium Modal Header -->
                <div class="modal-header-premium"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                            color: white; padding: 20px 24px; border-radius: 16px 16px 0 0;
                            display: flex; justify-content: space-between; align-items: center; border: none;">

                    <div class="file-info-header" style="display: flex; align-items: center; gap: 12px;">
                        <div class="file-icon"
                            style="width: 40px; height: 40px; border-radius: 10px;
                                                     background: rgba(255,255,255,0.2); display: flex;
                                                     align-items: center; justify-content: center;">
                            @if (in_array($previewMedia->extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']))
                                <i class="icon-image" style="font-size: 20px; color: white;"></i>
                            @elseif(in_array($previewMedia->extension, ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv', 'm4v', '3gp', '3g2', 'ogv']))
                                <i class="icon-video" style="font-size: 20px; color: white;"></i>
                            @elseif($previewMedia->extension === 'pdf')
                                <i class="icon-file-text" style="font-size: 20px; color: white;"></i>
                            @else
                                <i class="icon-file" style="font-size: 20px; color: white;"></i>
                            @endif
                        </div>
                        <div>
                            <h5 class="modal-title" style="margin: 0; font-size: 18px; font-weight: 600;">
                                {{ $previewMedia->filename }}
                            </h5>
                            <div class="file-meta" style="font-size: 12px; opacity: 0.9; margin-top: 2px;">
                                {{ $previewMedia->human_readable_size }} • {{ strtoupper($previewMedia->extension) }}
                                @if ($previewMedia->dimensions ?? false)
                                    • {{ $previewMedia->dimensions }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="modal-actions" style="display: flex; gap: 8px; align-items: center;">
                        <!-- Download Button -->
                        <a href="{{ asset('storage/' . $previewMedia->path) }}" target="_blank" class="btn-download"
                            title="Download"
                            style="width: 36px; height: 36px; border-radius: 8px; background: rgba(255,255,255,0.2);
                                  border: none; display: flex; align-items: center; justify-content: center;
                                  color: white; text-decoration: none; transition: all 0.2s ease;">
                            <i class="icon-download" style="font-size: 16px;"></i>
                        </a>

                        <!-- Close Button -->
                        <button type="button" class="btn-close-premium" wire:click="closePreview"
                            style="width: 32px; height: 32px; border-radius: 50%; background: rgba(255,255,255,0.2);
                                       border: none; display: flex; align-items: center; justify-content: center;
                                       color: white; transition: all 0.2s ease;">
                            <i class="icon-x" style="font-size: 16px;"></i>
                        </button>
                    </div>
                </div>

                <!-- Premium Modal Body -->
                <div class="modal-body-premium"
                    style="background: white; border-radius: 0 0 16px 16px; padding: 0; max-height: 75vh; overflow: hidden;">

                    <div class="preview-container"
                        style="display: flex; justify-content: center; align-items: center; min-height: 400px;">
                        @if (in_array($previewMedia->extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']))
                            <!-- Enhanced Image Preview -->
                            <div class="image-preview-container"
                                style="position: relative; max-width: 100%; max-height: 70vh;">
                                <img src="{{ asset('storage/' . $previewMedia->path) }}"
                                    alt="{{ $previewMedia->filename }}" class="preview-image"
                                    style="max-width: 100%; max-height: 70vh; object-fit: contain; border-radius: 8px;
                                            box-shadow: 0 10px 40px rgba(0,0,0,0.3); animation: zoomInImage 0.5s ease-out;">
                            </div>
                        @elseif(in_array($previewMedia->extension, ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv', 'm4v', '3gp', '3g2', 'ogv']))
                            <!-- Enhanced Video Preview -->
                            <div class="video-preview-container" style="width: 100%; max-width: 800px;">
                                <video controls class="preview-video"
                                    style="width: 100%; max-height: 70vh; border-radius: 12px;
                                              box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
                                    <source src="{{ asset('storage/' . $previewMedia->path) }}"
                                        type="{{ $previewMedia->mime }}">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @elseif($previewMedia->extension === 'pdf')
                            <!-- Enhanced PDF Preview -->
                            <div class="pdf-preview-container" style="width: 100%; height: 70vh; max-width: 900px;">
                                <iframe src="{{ asset('storage/' . $previewMedia->path) }}" class="preview-pdf"
                                    style="width: 100%; height: 100%; border: none; border-radius: 12px;
                                               box-shadow: 0 10px 40px rgba(0,0,0,0.2);"></iframe>
                            </div>
                        @else
                            <!-- Enhanced Unsupported File Preview -->
                            <div class="unsupported-preview"
                                style="text-align: center; padding: 60px 40px; animation: fadeInUp 0.5s ease-out;">
                                <div class="file-icon-large mb-4"
                                    style="width: 120px; height: 120px; border-radius: 20px; margin: 0 auto 24px;
                                            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
                                            display: flex; align-items: center; justify-content: center;
                                            box-shadow: 0 20px 40px rgba(240, 147, 251, 0.3);">
                                    <i class="icon-file" style="font-size: 48px; color: white;"></i>
                                </div>
                                <h4 style="color: #2d3748; margin-bottom: 12px; font-weight: 600;">
                                    Preview Not Available
                                </h4>
                                <p style="color: #718096; margin-bottom: 24px; font-size: 14px;">
                                    This file type cannot be previewed in the browser
                                </p>
                                <a href="{{ asset('storage/' . $previewMedia->path) }}" target="_blank"
                                    class="btn-download-large"
                                    style="display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px;
                                          background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                          color: white; text-decoration: none; border-radius: 10px;
                                          font-weight: 500; transition: all 0.2s ease; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                                    <i class="icon-download"></i>
                                    Download File
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>




@push('scripts')
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css">

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <script>
        // Close modals when clicking outside - Simple version
        document.addEventListener('livewire:init', function() {
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('modal-backdrop-premium')) {
                    @this.closePreview();
                }
            });
        });

        // Enhanced hover effects for grid items
        document.addEventListener('DOMContentLoaded', function() {
            // Function to handle file drop
            window.handleFileDrop = function(event) {
                event.preventDefault();
                const uploadArea = event.currentTarget;
                uploadArea.classList.remove('drag-over');

                const files = event.dataTransfer.files;
                if (files.length > 0) {
                    // Create a new DataTransfer object to hold the files
                    const dataTransfer = new DataTransfer();
                    for (let i = 0; i < files.length; i++) {
                        dataTransfer.items.add(files[i]);
                    }

                    // Set the files to the hidden input element
                    const fileInput = document.getElementById('file-upload');
                    fileInput.files = dataTransfer.files;

                    // Trigger the Livewire model update
                    const changeEvent = new Event('change', {
                        bubbles: true
                    });
                    fileInput.dispatchEvent(changeEvent);
                }
            };

            // Enhanced hover effects for old grid items
            const gridItems = document.querySelectorAll('.gallery-item.enhanced');
            gridItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-4px)';
                    this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.15)';

                    const actionsMenu = this.querySelector('.actions-menu');
                    const selectionOverlay = this.querySelector('.selection-overlay');
                    if (actionsMenu) {
                        actionsMenu.style.opacity = '1';
                        actionsMenu.style.transform = 'translateY(0)';
                    }
                    if (selectionOverlay) {
                        selectionOverlay.style.opacity = '1';
                    }
                });

                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 2px 8px rgba(0,0,0,0.1)';

                    const actionsMenu = this.querySelector('.actions-menu');
                    const selectionOverlay = this.querySelector('.selection-overlay');
                    if (actionsMenu) {
                        actionsMenu.style.opacity = '0';
                        actionsMenu.style.transform = 'translateY(-10px)';
                    }
                    if (selectionOverlay) {
                        selectionOverlay.style.opacity = '0';
                    }
                });
            });

            // Premium hover effects for new grid cards
            const premiumCards = document.querySelectorAll('.premium-media-card');
            premiumCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    // Enhanced card hover effect
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                    this.style.boxShadow = '0 20px 40px rgba(0,0,0,0.15)';

                    // Show actions menu
                    const actionsMenu = this.querySelector('.premium-actions-menu');
                    const selectionOverlay = this.querySelector('.selection-overlay');

                    if (actionsMenu) {
                        actionsMenu.style.opacity = '1';
                        actionsMenu.style.transform = 'translateY(0)';
                    }
                    if (selectionOverlay) {
                        selectionOverlay.style.opacity = '1';
                    }

                    // Add subtle gradient overlay to image
                    const imageWrapper = this.querySelector('.image-wrapper');
                    if (imageWrapper) {
                        const overlay = imageWrapper.querySelector('.image-overlay');
                        if (overlay) {
                            overlay.style.opacity = '1';
                        }
                    }
                });

                card.addEventListener('mouseleave', function() {
                    // Reset card hover effect
                    this.style.transform = 'translateY(0) scale(1)';
                    this.style.boxShadow = '0 4px 20px rgba(0,0,0,0.08)';

                    // Hide actions menu
                    const actionsMenu = this.querySelector('.premium-actions-menu');
                    const selectionOverlay = this.querySelector('.selection-overlay');

                    if (actionsMenu) {
                        actionsMenu.style.opacity = '0';
                        actionsMenu.style.transform = 'translateY(-10px)';
                    }
                    if (selectionOverlay) {
                        selectionOverlay.style.opacity = '0';
                    }

                    // Remove gradient overlay from image
                    const imageWrapper = this.querySelector('.image-wrapper');
                    if (imageWrapper) {
                        const overlay = imageWrapper.querySelector('.image-overlay');
                        if (overlay) {
                            overlay.style.opacity = '0';
                        }
                    }
                });
            });

            // Enhanced action button hover effects
            const actionButtons = document.querySelectorAll('.premium-action-btn');
            actionButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.1)';
                    this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.2)';
                });

                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                    this.style.boxShadow = '0 2px 8px rgba(0,0,0,0.1)';
                });
            });
        });

        // SweetAlert2 Event Listeners
        document.addEventListener('livewire:init', function() {
            Livewire.on('show-success', (message) => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: message,
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });

            Livewire.on('show-error', (message) => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: message,
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });

            Livewire.on('show-info', (message) => {
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: message,
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });

            // Override wire:confirm with SweetAlert2
            window.addEventListener('livewire:before', (event) => {
                if (event.detail.name === 'callMethod') {
                    const method = event.detail.params[0];
                    if (method === 'deleteFile' || method === 'deleteSelected') {
                        event.preventDefault();

                        let message = 'Are you sure you want to delete this file?';
                        if (method === 'deleteSelected') {
                            const selectedCount = @json(count($selectedItems));
                            message = `Are you sure you want to delete ${selectedCount} selected files?`;
                        }

                        Swal.fire({
                            title: 'Are you sure?',
                            text: message,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                @this.call(method, ...event.detail.params.slice(1));
                            }
                        });
                    }
                }
            });
        });

        // Preserve scroll position during pagination
        document.addEventListener('DOMContentLoaded', function() {
            let scrollPosition = null;
            let isPaginationRequest = false;

            // Save scroll position before Livewire requests
            document.addEventListener('livewire:before', function(event) {
                // Check if this is a pagination request
                if (event.target && event.target.href && event.target.href.includes('page=')) {
                    isPaginationRequest = true;
                    scrollPosition = window.scrollY;
                }
            });

            // Restore scroll position after Livewire updates
            document.addEventListener('livewire:updated', function() {
                if (scrollPosition !== null && isPaginationRequest) {
                    // Use setTimeout to ensure DOM is fully updated
                    setTimeout(function() {
                        window.scrollTo({
                            top: scrollPosition,
                            behavior: 'auto'
                        });
                        scrollPosition = null;
                        isPaginationRequest = false;
                    }, 10);
                }
            });

            // Handle pagination link clicks specifically
            document.addEventListener('click', function(e) {
                const target = e.target.closest('a');
                if (target && target.href) {
                    // Check if it's a pagination link
                    if (target.href.includes('page=') ||
                        target.classList.contains('page-link') ||
                        target.closest('.pagination')) {
                        scrollPosition = window.scrollY;
                        isPaginationRequest = true;
                    }
                }
            });

            // Also handle Livewire pagination method calls
            document.addEventListener('livewire:before', function(event) {
                if (event.detail && event.detail.name === 'callMethod') {
                    const methodName = event.detail.params[0];
                    if (methodName && (methodName.includes('paginate') || methodName === 'nextPage' ||
                            methodName === 'previousPage')) {
                        scrollPosition = window.scrollY;
                        isPaginationRequest = true;
                    }
                }
            });

            // Add drag and drop event listeners
            const uploadArea = document.querySelector('.uploadfile');
            if (uploadArea) {
                uploadArea.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('drag-over');
                });

                uploadArea.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    this.classList.remove('drag-over');
                });
            }
        });

        // Enhanced modal and interaction handlers
        document.addEventListener('DOMContentLoaded', function() {
            // ESC key to close modals
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    @this.closePreview();
                    @this.closeRenameModal();
                }
            });

            // Enhanced hover effects for modal buttons
            const modalButtons = document.querySelectorAll(
                '.btn-download, .btn-close-premium, .btn-close-enhanced, .btn-cancel-enhanced, .btn-rename-enhanced'
            );
            modalButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05)';
                });

                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });

            // Enhanced modal backdrop click handlers
            document.addEventListener('click', function(e) {
                // Close preview modal when clicking backdrop
                if (e.target.classList.contains('modal-backdrop-premium')) {
                    @this.closePreview();
                }

                // Close rename modal when clicking backdrop
                if (e.target.classList.contains('modal-backdrop-enhanced')) {
                    @this.closeRenameModal();
                }
            });

            // Enhanced ripple effect for buttons
            const rippleButtons = document.querySelectorAll('.premium-btn');
            rippleButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const ripple = this.querySelector('.btn-ripple');
                    if (ripple) {
                        ripple.style.width = '300px';
                        ripple.style.height = '300px';
                        ripple.style.opacity = '0';

                        setTimeout(() => {
                            ripple.style.width = '0';
                            ripple.style.height = '0';
                            ripple.style.opacity = '1';
                        }, 300);
                    }
                });
            });

            // Enhanced glow effect for view toggle button
            const viewToggleBtn = document.querySelector('.view-toggle-btn');
            if (viewToggleBtn) {
                viewToggleBtn.addEventListener('mouseenter', function() {
                    const glow = this.querySelector('.btn-glow');
                    if (glow) {
                        glow.style.opacity = '1';
                    }
                });

                viewToggleBtn.addEventListener('mouseleave', function() {
                    const glow = this.querySelector('.btn-glow');
                    if (glow) {
                        glow.style.opacity = '0';
                    }
                });
            }

            // Enhanced table row selection effects
            const tableRows = document.querySelectorAll('.premium-table-row');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    const actionButtons = this.querySelectorAll('.premium-action-btn');
                    actionButtons.forEach(btn => {
                        btn.style.opacity = '1';
                        btn.style.transform = 'scale(1)';
                    });
                });

                row.addEventListener('mouseleave', function() {
                    const actionButtons = this.querySelectorAll('.premium-action-btn');
                    actionButtons.forEach(btn => {
                        btn.style.opacity = '0.8';
                    });
                });
            });

            // Enhanced drag and drop for upload area
            const uploadArea = document.querySelector('.uploadfile');
            if (uploadArea) {
                uploadArea.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    this.classList.add('drag-over');
                    this.style.borderColor = '#667eea';
                    this.style.background =
                        'linear-gradient(135deg, rgba(102, 126, 234, 0.05) 0%, rgba(118, 75, 162, 0.05) 100%)';
                });

                uploadArea.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    this.classList.remove('drag-over');
                    this.style.borderColor = '#e2e8f0';
                    this.style.background = 'transparent';
                });

                uploadArea.addEventListener('drop', function(e) {
                    e.preventDefault();
                    this.classList.remove('drag-over');
                    this.style.borderColor = '#e2e8f0';
                    this.style.background = 'transparent';

                    // Add a subtle success animation
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                });
            }

            // Enhanced form input focus effects
            const formInputs = document.querySelectorAll('.form-control-enhanced');
            formInputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.borderColor = '#667eea';
                    this.style.boxShadow = '0 0 0 3px rgba(102, 126, 234, 0.1)';
                });

                input.addEventListener('blur', function() {
                    this.style.borderColor = '#e2e8f0';
                    this.style.boxShadow = 'none';
                });
            });

            // Enhanced animation for new files appearing
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === 1 && node.classList && node.classList
                            .contains('premium-table-row')) {
                            node.style.opacity = '0';
                            node.style.transform = 'translateY(20px)';
                            setTimeout(() => {
                                node.style.transition =
                                    'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                                node.style.opacity = '1';
                                node.style.transform = 'translateY(0)';
                            }, 50);
                        }
                    });
                });
            });

            const tableBody = document.querySelector('.premium-table tbody');
            if (tableBody) {
                observer.observe(tableBody, {
                    childList: true
                });
            }
        });
    </script>
@endpush
