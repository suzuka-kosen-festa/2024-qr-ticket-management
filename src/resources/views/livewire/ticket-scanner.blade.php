<div  class="bg-gray-600 px-4 py-2 rounded-md text-white font-semibold">
    QRをスキャンしてください
    <div id="loading" role="status" aria-live="polite">ブラウザのカメラの使用を許可してください。</div>

    @if (session()->has('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition>
            <x-flash-success>
                {{ session('success') }}
            </x-flash-success>
        </div>
    @endif

    @if (session()->has('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition>
            <x-flash-error>
                {{ session('error') }}
            </x-flash-error>
        </div>
    @endif

    <canvas id="canvas" class="qr-canvas" hidden></canvas>

    <style>
        .qr-canvas {
            width: 100%;
            height: 720px;
        }
    </style>

    @push('scripts')
        <!-- jsQRライブラリの読み込み -->
        <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const video = document.createElement('video');
                const canvasElement = document.getElementById('canvas');
                const canvas = canvasElement.getContext('2d');
                const loading = document.getElementById('loading');
                let previousData = '';
                let scanTimeout;

                // カメラへのアクセスを要求
                function startCamera() {
                    navigator.mediaDevices.getUserMedia({
                            video: {
                                facingMode: 'environment',
                            }
                        })
                        .then((stream) => {
                            loading.innerText = 'ロード中...';
                            video.srcObject = stream;
                            video.setAttribute('playsinline', true); // iOS対応
                            video.play();
                            requestAnimationFrame(tick);
                        })
                        .catch((error) => {
                            console.error('カメラのアクセスに失敗しました:', error);
                            loading.innerText = 'カメラのアクセスが拒否されました。ブラウザの設定を確認してください。';
                        });
                }

                function tick() {
                    if (video.readyState === video.HAVE_ENOUGH_DATA) {
                        loading.hidden = true;
                        canvasElement.hidden = false;

                        canvasElement.height = video.videoHeight;
                        canvasElement.width = video.videoWidth;
                        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);

                        var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
                        var code = jsQR(imageData.data, imageData.width, imageData.height, {
                            inversionAttempts: 'dontInvert',
                        });

                        if (code && code.data !== previousData) {
                            previousData = code.data;
                            clearTimeout(scanTimeout);
                            console.log('QRコードを読み取りました:', code.data);
                            @this.attend(code.data)
                            scanTimeout = setTimeout(() => {
                                previousData = '';
                            }, 5000); // 5秒間同じコードを無視
                        }
                    }
                    requestAnimationFrame(tick);
                }

                // ページが読み込まれたらカメラを起動
                startCamera();

                // ページを離れるときにカメラを停止
                window.addEventListener('beforeunload', function() {
                    if (video.srcObject) {
                        video.srcObject.getTracks().forEach(track => track.stop());
                    }
                });
            });
        </script>
    @endpush
</div>
</div>
