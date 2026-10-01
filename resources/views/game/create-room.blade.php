<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Room - Werewolf</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
    * {
        box-sizing: border-box;
    }

    body {
        min-height: 100vh;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        font-family: 'Kanit', sans-serif;
        color: #ffffff;
        background:
            radial-gradient(circle at center,
                #2d1745 0%,
                #170d27 45%,
                #09060f 100%);
    }

    body::before,
    body::after {
        content: '';
        position: fixed;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        background: rgba(139, 92, 246, 0.08);
        filter: blur(100px);
        pointer-events: none;
    }

    body::before {
        top: -200px;
        left: -150px;
    }

    body::after {
        right: -150px;
        bottom: -200px;
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

    .room-card {
        position: relative;
        z-index: 2;
        width: min(92%, 500px);
        padding: 42px 38px;
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 24px;
        background: rgba(17, 10, 30, 0.88);
        box-shadow:
            0 25px 80px rgba(0, 0, 0, 0.5),
            inset 0 1px 0 rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(12px);
    }

    .room-icon {
        margin-bottom: 10px;
        font-size: 52px;
        text-align: center;
    }

    .room-title {
        margin-bottom: 6px;
        font-size: 34px;
        font-weight: 700;
        text-align: center;
        letter-spacing: 1px;
    }

    .room-subtitle {
        margin-bottom: 32px;
        color: rgba(255, 255, 255, 0.62);
        font-size: 15px;
        text-align: center;
    }

    .form-label {
        margin-bottom: 8px;
        font-weight: 500;
        color: rgba(255, 255, 255, 0.9);
    }

    .form-control,
    .form-select {
        min-height: 52px;
        border: 1px solid rgba(255, 255, 255, 0.12);
        border-radius: 12px;
        color: #ffffff;
        background: rgba(255, 255, 255, 0.06);
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.35);
    }

    .form-control:focus,
    .form-select:focus {
        border-color: rgba(168, 85, 247, 0.8);
        color: #ffffff;
        background: rgba(255, 255, 255, 0.08);
        box-shadow: 0 0 0 0.2rem rgba(168, 85, 247, 0.15);
    }

    .form-select option {
        color: #ffffff;
        background: #1b102b;
    }

    .difficulty-info {
        margin-top: 10px;
        color: rgba(255, 255, 255, 0.5);
        font-size: 13px;
    }

    .btn-create {
        width: 100%;
        min-height: 54px;
        margin-top: 24px;
        border: none;
        border-radius: 14px;
        color: #ffffff;
        font-size: 17px;
        font-weight: 600;
        background: linear-gradient(135deg,
                #8b5cf6,
                #6d28d9);
        box-shadow: 0 12px 30px rgba(109, 40, 217, 0.3);
        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .btn-create:hover {
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 16px 36px rgba(109, 40, 217, 0.4);
    }

    .btn-back {
        display: block;
        margin-top: 20px;
        color: rgba(255, 255, 255, 0.55);
        font-size: 14px;
        text-align: center;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .btn-back:hover {
        color: #ffffff;
    }

    .alert {
        border-radius: 12px;
        color: #ffffff;
        background: rgba(220, 38, 38, 0.15);
        border-color: rgba(248, 113, 113, 0.25);
    }

    @media (max-width: 576px) {
        .room-card {
            padding: 32px 24px;
        }

        .room-title {
            font-size: 28px;
        }
    }
    </style>
</head>

<body>

    <div class="smoke-wrapper">
        <div class="smoke-layer-1"></div>
        <div class="smoke-layer-2"></div>
    </div>

    <div class="room-card">

        <div class="room-icon">🐺</div>

        <h1 class="room-title">CREATE ROOM</h1>

        <p class="room-subtitle">
            สร้างห้องเกม Werewolf และชวนเพื่อนเข้ามาเล่น
        </p>

        @if ($errors->any())
        <div class="alert mb-4">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('rooms.store') }}">
            @csrf

            <div class="mb-4">
                <label for="host_name" class="form-label">
                    Host Name
                </label>

                <input type="text" id="host_name" name="host_name" class="form-control" value="{{ old('host_name') }}"
                    placeholder="กรอกชื่อของคุณ" maxlength="45" required autofocus>
            </div>

            <div class="mb-2">
                <label for="difficulty" class="form-label">
                    Difficulty
                </label>

                <select id="difficulty" name="difficulty" class="form-select" required>
                    <option value="" disabled {{ old('difficulty') === null ? 'selected' : '' }}>
                        เลือกระดับความยาก
                    </option>

                    <option value="easy" {{ old('difficulty') === 'easy' ? 'selected' : '' }}>
                        Easy
                    </option>

                    <option value="hard" {{ old('difficulty') === 'hard' ? 'selected' : '' }}>
                        Hard
                    </option>
                </select>
            </div>

            <div class="difficulty-info">
                Easy: เหมาะสำหรับผู้เล่นใหม่<br>
                Hard: เกมมีความท้าทายมากขึ้น
            </div>

            <button type="submit" class="btn btn-create">
                Create Room
            </button>
        </form>

        <a href="{{ url('/room-test') }}" class="btn-back">
            ← Back
        </a>

    </div>

</body>

</html>