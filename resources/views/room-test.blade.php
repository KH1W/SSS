<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ware Woof - Create or Join Room</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;600;700;900&display=swap" rel="stylesheet">

    <style>
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



    .room-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 24px;
    }

    .room-section {
        padding: 28px;
        background-color: rgba(8, 7, 20, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 1rem;
    }

    .section-title {
        font-weight: 700;
    }

    .section-description {
        color: #94a3b8;
    }

    .form-label {
        color: #e2e8f0;
        font-weight: 600;
    }

    .form-control-custom,
    .form-select-custom {
        background-color: rgba(0, 0, 0, 0.3) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        color: #ffffff !important;
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        transition: all 0.2s ease-in-out;
    }

    .form-control-custom::placeholder {
        color: #6c757d;
    }

    .form-control-custom:hover,
    .form-select-custom:hover {
        border-color: #2563eb !important;
    }

    .form-control-custom:focus,
    .form-select-custom:focus {
        border-color: #2563eb !important;
        box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.3) !important;
    }

    .form-select-custom option {
        background-color: #111126;
        color: #ffffff;
    }

    .btn-create {
        background-color: #9333ea;
        border: none;
        color: #ffffff;
        border-radius: 0.75rem;
        padding: 0.75rem 1.5rem;
        font-weight: 700;
        transition: background-color 0.2s ease;
    }

    .btn-create:hover {
        background-color: #a855f7;
        color: #ffffff;
    }

    .btn-join {
        background-color: #2563eb;
        border: none;
        color: #ffffff;
        border-radius: 0.75rem;
        padding: 0.75rem 1.5rem;
        font-weight: 700;
        transition: background-color 0.2s ease;
    }

    .btn-join:hover {
        background-color: #3b82f6;
        color: #ffffff;
    }

    .current-room {
        background-color: rgba(168, 85, 247, 0.08);
        border: 1px solid rgba(168, 85, 247, 0.25);
        border-radius: 0.75rem;
    }

    .current-room-code {
        color: #c084fc;
        font-weight: 700;
        letter-spacing: 0.08em;
    }

    .current-room-link {
        color: #c084fc;
        text-decoration: none;
        font-weight: 600;
    }

    .current-room-link:hover {
        color: #d8b4fe;
    }

    .btn-cleanup {
        background-color: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #fca5a5;
        border-radius: 0.75rem;
        padding: 0.65rem 1rem;
        font-weight: 600;
    }

    .btn-cleanup:hover {
        background-color: rgba(239, 68, 68, 0.2);
        color: #fecaca;
    }

    .alert-custom {
        background-color: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #fecaca;
        border-radius: 0.75rem;
    }

    .required-mark {
        color: #c084fc;
    }

    @media (max-width: 768px) {
        .room-grid {
            grid-template-columns: 1fr;
        }

        .room-section {
            padding: 24px;
        }
    }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center px-3 py-5">

    <div class="smoke-wrapper">
        <div class="smoke-layer-1"></div>
        <div class="smoke-layer-2"></div>
    </div>

    <main class="w-100" style="max-width: 1100px;">

        <div class="text-center mb-5">

            <h1 class="display-5 page-title text-uppercase">
                WARE <span>WOOF</span>
            </h1>

            <p class="page-subtitle mt-3 mb-0">
                สร้างหรือเข้าร่วมห้องเกม Werewolf
            </p>

        </div>

        @if ($currentRoom !== null)
        <div class="current-room p-4 mb-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

                <div>
                    <div class="small text-secondary">
                        ห้องล่าสุดของคุณ
                    </div>

                    <div class="current-room-code fs-5 mt-1">
                        {{ $currentRoom['code'] }}
                    </div>
                </div>

                <a href="{{ route('rooms.show', ['code' => $currentRoom['code']]) }}" class="current-room-link">
                    {{ $currentRoom['game_uuid'] !== null
                            ? 'กลับเข้าเกม →'
                            : 'กลับ Lobby →' }}
                </a>

            </div>

        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-custom mb-4" role="alert">

            <div class="fw-bold mb-2">
                ไม่สามารถดำเนินการได้
            </div>

            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
        @endif

        <div class="custom-card">

            <div class="room-grid">

                {{-- create room --}}
                <section class="room-section">

                    <div class="mb-4">
                        <h2 class="section-title h4 mb-1">
                            Create Room
                        </h2>

                        <p class="section-description mb-0">
                            สร้างห้องใหม่แล้วรอผู้เล่นเข้าร่วม
                        </p>
                    </div>

                    <form method="POST" action="{{ route('rooms.store') }}">
                        @csrf

                        <div class="mb-4">

                            <label for="host_name" class="form-label">
                                ชื่อของคุณ
                                <span class="required-mark">*</span>
                            </label>

                            <input id="host_name" type="text" name="host_name" value="{{ old('host_name') }}"
                                maxlength="45" required autofocus autocomplete="name" placeholder="กรอกชื่อของคุณ"
                                class="form-control form-control-custom">

                        </div>

                        <div class="mb-4">

                            <label for="difficulty" class="form-label">
                                ระดับความยาก
                                <span class="required-mark">*</span>
                            </label>

                            <select id="difficulty" name="difficulty" required class="form-select form-select-custom">

                                <option value="easy" @selected(old('difficulty', 'easy' )==='easy' )>
                                    Easy — เปิดเผย Role ของคนตาย
                                </option>

                                <option value="hard" @selected(old('difficulty')==='hard' )>
                                    Hard — ไม่เปิดเผย Role ของคนตาย
                                </option>

                            </select>

                        </div>

                        <button type="submit" class="btn btn-create w-100">
                            Create Room
                        </button>

                    </form>

                </section>

                {{-- join room --}}
                <section class="room-section">

                    <div class="mb-4">
                        <h2 class="section-title h4 mb-1">
                            Join Room
                        </h2>

                        <p class="section-description mb-0">
                            เข้าร่วมห้องเกมด้วยรหัสห้อง
                        </p>
                    </div>

                    <form method="POST" action="{{ route('rooms.join-form') }}">
                        @csrf

                        <div class="mb-4">

                            <label for="player_name" class="form-label">
                                ชื่อของคุณ
                                <span class="required-mark">*</span>
                            </label>

                            <input id="player_name" type="text" name="player_name" value="{{ old('player_name') }}"
                                maxlength="45" required autocomplete="name" placeholder="กรอกชื่อของคุณ"
                                class="form-control form-control-custom">

                        </div>

                        <div class="mb-4">

                            <label for="code" class="form-label">
                                รหัสห้อง
                                <span class="required-mark">*</span>
                            </label>

                            <input id="code" type="text" name="code" value="{{ old('code') }}" minlength="6"
                                maxlength="6" pattern="[A-Za-z0-9]{6}" required autocomplete="off" placeholder="ABC123"
                                class="form-control form-control-custom text-uppercase">

                        </div>

                        <button type="submit" class="btn btn-join w-100">
                            Join Room
                        </button>

                    </form>

                </section>

            </div>

        </div>

        @if ($currentRoom !== null)
        <div class="text-center mt-4">

            <form method="POST" action="{{ route('games.leave-unavailable', [
                    'code' => $currentRoom['code'],
                ]) }}" onsubmit="return confirm('ออกจากห้องที่ค้างถาวรหรือไม่?')">

                @csrf

                <button type="submit" class="btn btn-cleanup">
                    ออกจากห้องที่ข้อมูลเกมใช้ไม่ได้
                </button>

            </form>

        </div>
        @endif

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>