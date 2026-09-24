<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ไม่สามารถเปิดเกมได้ - Ware Woof</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        min-height: 100vh;
        overflow-x: hidden;
        background:
            radial-gradient(circle at top,
                #1e1b4b 0%,
                #11102b 45%,
                #080714 100%);
        color: #f8fafc;
        font-family: 'Kanit', sans-serif;
    }

    /* smoke background */
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

    .page {
        position: relative;
        z-index: 1;

        min-height: 100vh;
        padding: 40px 20px;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .custom-card {
        width: 100%;
        max-width: 620px;

        padding: 36px;

        background: rgba(30, 27, 75, 0.72);
        border: 1px solid rgba(167, 139, 250, 0.18);
        border-radius: 24px;

        box-shadow:
            0 24px 70px rgba(0, 0, 0, 0.45),
            inset 0 1px 0 rgba(255, 255, 255, 0.04);

        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
    }

    .error-icon {
        width: 82px;
        height: 82px;

        margin: 0 auto 24px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 24px;

        background:
            linear-gradient(135deg,
                rgba(251, 191, 36, 0.2),
                rgba(245, 158, 11, 0.08));

        border: 1px solid rgba(251, 191, 36, 0.25);

        color: #fbbf24;
        font-size: 38px;

        box-shadow:
            0 12px 35px rgba(0, 0, 0, 0.25);
    }

    .title {
        margin: 0;

        text-align: center;

        font-size: 32px;
        font-weight: 900;
        letter-spacing: 0.3px;
    }

    .subtitle {
        margin: 8px 0 28px;

        text-align: center;

        color: #a5a3b8;
        font-size: 15px;
    }

    .room-info {
        margin-bottom: 22px;
        padding: 20px;

        background: rgba(8, 7, 20, 0.42);
        border: 1px solid rgba(148, 163, 184, 0.12);
        border-radius: 18px;
    }

    .info-label {
        margin-bottom: 6px;

        color: #9ca3af;
        font-size: 13px;
        font-weight: 500;
    }

    .room-code {
        color: #c4b5fd;

        font-size: 25px;
        font-weight: 800;
        letter-spacing: 3px;
    }

    .message-card {
        margin-bottom: 24px;
        padding: 20px;

        background: rgba(15, 23, 42, 0.52);
        border: 1px solid rgba(148, 163, 184, 0.1);
        border-radius: 18px;
    }

    .message-card p {
        margin: 0;

        color: #d1d5db;
        line-height: 1.8;
        font-size: 15px;
    }

    .message-card p+p {
        margin-top: 12px;
    }

    .warning-box {
        margin-bottom: 24px;
        padding: 15px 17px;

        display: flex;
        gap: 12px;
        align-items: flex-start;

        background: rgba(251, 191, 36, 0.08);
        border: 1px solid rgba(251, 191, 36, 0.18);
        border-radius: 14px;

        color: #fde68a;
        font-size: 14px;
        line-height: 1.7;
    }

    .warning-icon {
        flex-shrink: 0;

        font-size: 18px;
    }

    .action-group {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .btn-leave {
        width: 100%;
        min-height: 48px;

        border: 1px solid rgba(239, 68, 68, 0.25);
        border-radius: 14px;

        background:
            linear-gradient(135deg,
                rgba(127, 29, 29, 0.72),
                rgba(69, 10, 10, 0.72));

        color: #fecaca;

        font-family: 'Kanit', sans-serif;
        font-size: 15px;
        font-weight: 600;

        transition:
            transform 0.2s ease,
            border-color 0.2s ease,
            background 0.2s ease;
    }

    .btn-leave:hover {
        transform: translateY(-1px);

        border-color: rgba(248, 113, 113, 0.45);

        background:
            linear-gradient(135deg,
                rgba(153, 27, 27, 0.82),
                rgba(69, 10, 10, 0.82));

        color: #fee2e2;
    }

    .btn-home {
        width: 100%;
        min-height: 48px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: 1px solid rgba(148, 163, 184, 0.14);
        border-radius: 14px;

        background: rgba(15, 23, 42, 0.55);

        color: #d1d5db;

        font-size: 15px;
        font-weight: 500;

        text-decoration: none;

        transition:
            transform 0.2s ease,
            background 0.2s ease,
            border-color 0.2s ease;
    }

    .btn-home:hover {
        transform: translateY(-1px);

        background: rgba(30, 41, 59, 0.8);
        border-color: rgba(167, 139, 250, 0.25);

        color: #ffffff;
    }

    .footer-text {
        margin-top: 22px;

        text-align: center;

        color: #6b7280;
        font-size: 12px;
    }

    @media (max-width: 576px) {
        .page {
            padding: 24px 16px;
        }

        .custom-card {
            padding: 26px 20px;
            border-radius: 20px;
        }

        .title {
            font-size: 26px;
        }

        .error-icon {
            width: 70px;
            height: 70px;

            font-size: 32px;
            border-radius: 20px;
        }

        .room-code {
            font-size: 22px;
        }
    }
    </style>
</head>

<body>

    <div class="smoke-wrapper">
        <div class="smoke-layer-1"></div>
        <div class="smoke-layer-2"></div>
    </div>

    <main class="page">

        <section class="custom-card">

            <div class="error-icon">
                ⚠
            </div>

            <h1 class="title">
                ไม่สามารถเปิดเกมนี้ได้
            </h1>

            <p class="subtitle">
                Ware Woof
            </p>

            <div class="room-info">
                <div class="info-label">
                    ห้องที่ไม่สามารถเปิดได้
                </div>

                <div class="room-code">
                    {{ $code }}
                </div>
            </div>

            <div class="message-card">
                <p>
                    ห้อง <strong>{{ $code }}</strong>
                    มีปัญหาข้อมูลเกม จึงยังเล่นต่อไม่ได้
                </p>

                <p>
                    คุณสามารถออกจากห้องนี้ แล้วสร้างหรือเข้าร่วมห้องใหม่ได้
                    เมื่อออกแล้วจะกลับเข้าห้องเดิมไม่ได้
                </p>
            </div>

            <div class="warning-box">
                <div class="warning-icon">
                    ⚠
                </div>

                <div>
                    การออกจากห้องนี้เป็นการออกแบบถาวร
                    กรุณาตรวจสอบก่อนกดยืนยัน
                </div>
            </div>

            <div class="action-group">

                <form method="POST" action="{{ route('games.leave-unavailable', ['code' => $code]) }}"
                    onsubmit="return confirm('ยืนยันออกจากห้องนี้ถาวรหรือไม่?')">
                    @csrf

                    <button type="submit" class="btn-leave">
                        ออกจากห้องนี้
                    </button>
                </form>

                <a href="{{ route('rooms.index') }}" class="btn-home">
                    กลับหน้าหลักโดยยังไม่ออกจากห้อง
                </a>

            </div>

            <div class="footer-text">
                Ware Woof · Werewolf Online
            </div>

        </section>

    </main>

</body>

</html>