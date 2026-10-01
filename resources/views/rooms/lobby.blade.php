<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="room-code" content="{{ $room['code'] }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Player List - Ware Woof</title>

    @vite(['resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;600;700;900&display=swap" rel="stylesheet">

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap');

    body {
        min-height: 100vh;
        font-family: 'Kanit', sans-serif;
        color: #ffffff;
        background:
            radial-gradient(circle at 50% 30%,
                #1e1b4b 0%,
                #080714 50%);
        background-color: #080714;
        background-attachment: fixed;
    }

    h1 {
        font-family: 'Cinzel', serif;
    }

    body::after {
        content: '';
        position: fixed;
        right: 6%;
        top: 45px;
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #ffd66b;
        box-shadow:
            0 0 20px rgba(255, 214, 107, .65),
            0 0 60px rgba(255, 166, 0, .35);
        opacity: .95;
        pointer-events: none;
        z-index: 0;
    }

    .smoke-wrapper {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100vw;
        height: 45vh;
        overflow: hidden;
        pointer-events: none;
        z-index: 1;
    }

    .smoke-layer-1 {
        position: absolute;
        bottom: -15%;
        left: -10%;
        width: 120%;
        height: 100%;
        background:
            radial-gradient(ellipse at 30% 100%,
                rgba(148, 163, 184, 0.4) 0%,
                rgba(71, 85, 105, 0.15) 50%,
                transparent 80%);
        filter: blur(20px);
        animation: fogPulseVisible1 8s ease-in-out infinite alternate;
    }

    .smoke-layer-2 {
        position: absolute;
        bottom: -20%;
        right: -10%;
        width: 130%;
        height: 90%;
        background:
            radial-gradient(ellipse at 70% 100%,
                rgba(226, 232, 240, 0.35) 0%,
                rgba(148, 163, 184, 0.1) 45%,
                transparent 75%);
        filter: blur(25px);
        animation: fogPulseVisible2 11s ease-in-out infinite alternate;
    }

    @keyframes fogPulseVisible1 {
        0% {
            opacity: 0.3;
            transform: translate3d(0, 0, 0) scale(0.9);
        }

        50% {
            opacity: 0.8;
            transform: translate3d(-4%, -15px, 0) scale(1.15);
        }

        100% {
            opacity: 0.4;
            transform: translate3d(-8%, -5px, 0) scale(1.02);
        }
    }

    @keyframes fogPulseVisible2 {
        0% {
            opacity: 0.4;
            transform: translate3d(0, 0, 0) scale(1.1);
        }

        50% {
            opacity: 0.3;
            transform: translate3d(5%, -20px, 0) scale(0.95);
        }

        100% {
            opacity: 0.6;
            transform: translate3d(10%, -10px, 0) scale(1.18);
        }
    }


    @keyframes floatSmoke {

        0%,
        100% {
            transform: translate(0, 0) scale(1);
        }

        50% {
            transform: translate(40px, -30px) scale(1.15);
        }
    }

    main,
    .container {
        position: relative;
        z-index: 10;
    }

    .page {
        max-width: 768px;
        width: 100%;
    }

    .page-title {
        font-weight: 900;
        letter-spacing: 0.08em;
    }

    .page-title span {
        color: #a855f7;
    }

    .page-subtitle {
        color: #94a3b8;
    }

    .custom-card {
        background-color: rgba(76, 29, 149, 0.18);
        border: 1px solid rgba(168, 85, 247, 0.45);
        border-radius: 1.5rem;
        backdrop-filter: blur(10px);
    }

    .room-info {
        background-color: rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 1rem;
    }

    .room-code {
        color: #c084fc;
        font-weight: 900;
        letter-spacing: 0.12em;
    }

    .info-label {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .info-value {
        color: #ffffff;
        font-weight: 700;
    }

    .player-item {
        background-color: rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 1rem;
    }

    .avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        flex-shrink: 0;
    }

    .avatar-host {
        background:
            linear-gradient(135deg,
                #4c1d95,
                #9333ea);
    }

    .avatar-player {
        background:
            linear-gradient(135deg,
                #172554,
                #2563eb);
    }

    .player-name {
        font-weight: 700;
    }

    .player-you {
        font-size: 0.85rem;
    }

    .player-you.purple {
        color: #c084fc;
    }

    .player-you.blue {
        color: #60a5fa;
    }

    .host-badge {
        background-color: rgba(168, 85, 247, 0.15);
        border: 1px solid rgba(168, 85, 247, 0.3);
        color: #c084fc;
        border-radius: 999px;
        padding: 0.25rem 0.65rem;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .waiting-text {
        color: #94a3b8;
    }

    .btn-secondary-game {
        min-height: 38px;
        padding: 8px 17px;
        border-radius: 9px;
        background: rgba(239, 68, 68, 0.12);
        border: 1px solid rgba(248, 113, 113, 0.4);
        color: #fca5a5;
        font-family: 'Kanit', sans-serif;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-leave {
        color: #fca5a5;
        background: rgba(239, 68, 68, 0.2);
        border-color: rgba(248, 113, 113, 0.6);
    }

    .btn-leave {
        background-color: rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #cbd5e1;
        border-radius: 0.75rem;
        padding: 0.7rem 1.2rem;
        font-weight: 700;
    }

    .btn-leave:hover {
        background-color: rgba(239, 68, 68, 0.1);
        border-color: rgba(239, 68, 68, 0.3);
        color: #fca5a5;
    }

    .btn-start {
        background-color: #9333ea;
        border: none;
        color: #ffffff;
        border-radius: 0.75rem;
        padding: 0.7rem 1.2rem;
        font-weight: 700;
    }

    .btn-start:hover {
        background-color: #a855f7;
        color: #ffffff;
    }

    .btn-start:disabled {
        background-color: #475569;
        color: #94a3b8;
        opacity: 0.7;
    }

    .btn-refresh {
        color: #c084fc;
        text-decoration: none;
        font-weight: 600;
    }

    .btn-refresh:hover {
        color: #d8b4fe;
    }

    .alert-custom {
        background-color: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #fecaca;
        border-radius: 0.75rem;
    }

    .game-session {
        background-color: rgba(168, 85, 247, 0.08);
        border: 1px solid rgba(168, 85, 247, 0.25);
        border-radius: 1rem;
    }

    .game-session a {
        color: #c084fc;
        text-decoration: none;
        font-weight: 700;
    }

    .game-session a:hover {
        color: #d8b4fe;
    }

    .realtime-status {
        font-size: 0.8rem;
        opacity: 0.75;
        margin-bottom: 0.5rem;
    }

    .room-code-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .copy-room-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 8px;
        background: rgba(168, 85, 247, 0.12);
        border: 1px solid rgba(168, 85, 247, 0.35);
        color: #c084fc;
        font-family: 'Kanit', sans-serif;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .copy-room-btn:hover {
        background: rgba(168, 85, 247, 0.22);
        border-color: rgba(168, 85, 247, 0.6);
        color: #e9d5ff;
    }

    .copy-room-btn.copied {
        background: rgba(74, 122, 102, 0.16);
        border-color: rgba(110, 170, 143, 0.45);
        color: #b7e4c7;
    }
    </style>

</head>

<body class="d-flex justify-content-center px-3 py-5">

    <div class="smoke-wrapper">
        <div class="smoke-layer-1"></div>
        <div class="smoke-layer-2"></div>
    </div>

    <main class="page">

        <div class="text-center mb-5">

            <h1 class="display-5 page-title text-uppercase">
                PLAYER <span>LIST</span>
            </h1>

            <div id="realtime-status" class="realtime-status" aria-live="polite">
                กำลังเชื่อมต่อ...
            </div>

            <p class="page-subtitle mt-3 mb-0">
                รอผู้เล่นเข้าร่วมก่อนเริ่มเกม
            </p>

        </div>

        @if ($errors->any())

        <div class="alert alert-custom mb-4" role="alert">

            <div class="fw-bold mb-2">
                ไม่สามารถดำเนินการได้
            </div>

            <ul class="mb-0 ps-3">

                @foreach ($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

                @endforeach

            </ul>

        </div>

        @endif

        <div class="custom-card p-4 p-md-5">

            {{-- room information --}}
            <div class="room-info p-4 mb-4">

                <div class="row g-4">

                    <div class="col-6">

                        <div class="info-label">
                            Room Code
                        </div>

                        <div class="room-code-wrapper mt-1">

                            <div class="room-code fs-4" id="room-code">
                                {{ $room['code'] }}
                            </div>

                            <button type="button" class="copy-room-btn" id="copy-room-btn" title="คัดลอก Room Code">
                                <span id="copy-room-icon">⧉</span>
                                <span id="copy-room-text">คัดลอก</span>
                            </button>

                        </div>

                    </div>

                    <div class="col-6">

                        <div class="info-label">
                            Difficulty
                        </div>

                        <div class="info-value mt-1">
                            {{ $room['difficulty'] === 'easy' ? 'Easy' : 'Hard' }}
                        </div>

                    </div>

                    <div class="col-6">

                        <div class="info-label">
                            Status
                        </div>

                        <div class="info-value mt-1">
                            @switch($room['status'])
                            @case('waiting')
                            รอผู้เล่น
                            @break

                            @case('in_progress')
                            กำลังเล่น
                            @break

                            @case('finished')
                            จบเกม
                            @break

                            @case('roles_assigned')
                            เตรียมเริ่มเกม
                            @break

                            @default
                            {{ $room['status'] }}
                            @endswitch
                        </div>

                    </div>

                    <div class="col-6">

                        <div class="info-label">
                            Players
                        </div>

                        <div class="info-value mt-1">
                            {{ count($room['players']) }} / 6
                        </div>

                    </div>

                </div>

            </div>

            {{-- player list --}}
            <div class="mb-4">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h2 class="h5 fw-bold mb-0">
                        ผู้เล่น
                    </h2>

                </div>

                <div class="d-flex flex-column gap-2">

                    @foreach ($room['players'] as $player)

                    <div class="player-item p-3">

                        <div class="d-flex align-items-center justify-content-between gap-3">

                            <div class="d-flex align-items-center gap-3">

                                <div class="avatar {{
                                    $loop->index % 2 === 0
                                    ? 'avatar-host'
                                    : 'avatar-player'
                                }}">
                                    {{ mb_strtoupper(mb_substr($player['name'], 0, 1, 'UTF-8'), 'UTF-8') }}
                                </div>

                                <div>

                                    <div class="player-name">

                                        {{ $player['name'] }}

                                        @if ($player['player_uuid'] === session('player_uuid'))

                                        <span class="player-you {{
                                            $loop->index % 2 === 0
                                            ? 'purple'
                                            : 'blue'
                                        }}">
                                            (คุณ)
                                        </span>

                                        @endif

                                    </div>

                                </div>

                            </div>

                            @if (
                            $player['player_uuid'] === $room['host_uuid']
                            )

                            <span class="host-badge">
                                HOST
                            </span>

                            @endif

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

            {{-- waiting message --}}
            @php
            $playerCount = count($room['players']);
            @endphp

            <div class="text-center waiting-text py-3">

                @if ($playerCount < 4) ต้องมีผู้เล่นอย่างน้อย 4 คนเพื่อเริ่มเกม @elseif ($playerCount> 6)

                    จำนวนผู้เล่นเกินจำนวนที่รองรับ

                    @elseif (session('player_uuid') === $room['host_uuid'])

                    พร้อมเริ่มเกมแล้ว

                    @else

                    รอ Host กด Start Game

                    @endif

            </div>

            {{-- actions --}}
            @if (
            $room['status'] === 'waiting' &&
            collect($room['players'])->contains(
            'player_uuid',
            session('player_uuid')
            )
            )

            <div class="d-flex flex-column flex-md-row gap-2 mt-3">

                <form method="POST" action="{{ route('rooms.leave', ['code' => $room['code']]) }}" class="flex-fill">

                    @csrf

                    <button type="submit" class="btn btn-leave w-100">
                        ออกจากห้อง
                    </button>

                </form>

                @if (
                session('player_uuid') === $room['host_uuid']
                )

                <form method="POST" action="{{ route('rooms.start', ['code' => $room['code']]) }}" class="flex-fill">

                    @csrf

                    <button type="submit" class="btn btn-start w-100" @disabled($playerCount < 4 || $playerCount> 6)
                        >
                        เริ่มเกม
                    </button>

                </form>

                @endif

            </div>

            @endif

            {{-- game session --}}
            @if (
            ($room['game_uuid'] ?? null) !== null &&
            collect($room['players'])->contains(
            'player_uuid',
            session('player_uuid')
            )
            )

            <div class="game-session p-4 mt-4 text-center">

                <div class="fw-bold mb-2">
                    เกมพร้อมแล้ว
                </div>

                <a href="{{ route('games.show', ['code' => $room['code']]) }}">
                    เข้าหน้าเกม →
                </a>

            </div>

            @endif

        </div>

    </main>

    <script>
        const copyRoomButton = document.getElementById('copy-room-btn');
        const roomCode = document.getElementById('room-code');
        const copyRoomIcon = document.getElementById('copy-room-icon');
        const copyRoomText = document.getElementById('copy-room-text');

        let copyResetTimer;

        function copyFallback(text) {
            const input = document.createElement('textarea');
            input.value = text;
            input.readOnly = true;
            input.style.position = 'fixed';
            input.style.opacity = '0';

            document.body.appendChild(input);
            input.select();
            input.setSelectionRange(0, input.value.length);

            try {
                return document.execCommand('copy');
            } finally {
                input.remove();
            }
        }

        copyRoomButton?.addEventListener('click', async (event) => {
            event.preventDefault();

            const code = roomCode?.textContent.trim();

            if (!code) {
                return;
            }

            let copied = false;

            if (navigator.clipboard?.writeText) {
                try {
                    await navigator.clipboard.writeText(code);
                    copied = true;
                } catch {
                    // ลองวิธีสำรองหาก Clipboard API ถูกปฏิเสธ
                }
            }

            if (!copied) {
                try {
                    copied = copyFallback(code);
                } catch {
                    copied = false;
                }
            }

            if (!copied) {
                window.prompt('คัดลอกรหัสห้องนี้ด้วยตนเอง:', code);
                return;
            }

            clearTimeout(copyResetTimer);

            copyRoomButton.classList.add('copied');

            if (copyRoomIcon) copyRoomIcon.textContent = '✓';
            if (copyRoomText) copyRoomText.textContent = 'คัดลอกแล้ว';

            copyResetTimer = setTimeout(() => {
                copyRoomButton.classList.remove('copied');

                if (copyRoomIcon) copyRoomIcon.textContent = '⧉';
                if (copyRoomText) copyRoomText.textContent = 'คัดลอก';
            }, 1500);
        });
    </script>
    <!-- domain .test ไม่รองรับ navigator -->
    <!-- <script> 
    const copyRoomButton = document.getElementById('copy-room-btn');
    const roomCode = document.getElementById('room-code');
    const copyRoomIcon = document.getElementById('copy-room-icon');
    const copyRoomText = document.getElementById('copy-room-text');

    copyRoomButton?.addEventListener('click', async () => {
        try {
            await navigator.clipboard.writeText(roomCode.textContent.trim());

            copyRoomButton.classList.add('copied');
            copyRoomIcon.textContent = '✓';
            copyRoomText.textContent = 'คัดลอกแล้ว';

            setTimeout(() => {
                copyRoomButton.classList.remove('copied');
                copyRoomIcon.textContent = '⧉';
                copyRoomText.textContent = 'คัดลอก';
            }, 1500);

        } catch (error) {
            console.error('ไม่สามารถคัดลอก Room Code ได้:', error);
        }
    });
    </script> -->

</body>

</html>