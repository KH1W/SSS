<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Werewolf Online - {{ $game['room_code'] }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Kanit:wght@400;500;600;700;900&display=swap"
        rel="stylesheet">

    <style>
    * {
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    html {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    html::-webkit-scrollbar {
        display: none;
    }

    body {
        min-height: 100vh;
        margin: 0;
        color: #f8f7ff;
        font-family: 'Kanit', sans-serif;
        background:
            radial-gradient(circle at 82% 5%,
                rgba(255, 171, 0, .18) 0,
                rgba(255, 171, 0, .05) 12%,
                transparent 30%),
            radial-gradient(circle at 15% 30%,
                rgba(76, 29, 149, .18),
                transparent 35%),
            linear-gradient(135deg,
                #050816 0%,
                #0b0d1b 45%,
                #160b29 100%);

        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        inset: 0;
        pointer-events: none;
        background:
            linear-gradient(90deg,
                rgba(76, 29, 149, .08),
                transparent 35%,
                transparent 65%,
                rgba(88, 28, 135, .08));
        z-index: 0;
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

    .topbar {
        position: relative;
        z-index: 5;
        min-height: 58px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 28px;
        border-top: 3px solid #5b21b6;
        border-bottom: 1px solid rgba(139, 92, 246, .16);
        background: rgba(4, 6, 15, .82);
        backdrop-filter: blur(18px);
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .brand-icon {
        width: 32px;
        height: 32px;
        display: grid;
        place-items: center;
        border-radius: 9px;
        background: linear-gradient(135deg,
                #5b21b6,
                #9333ea);
        box-shadow: 0 0 20px rgba(147, 51, 234, .35);
        font-size: 17px;
    }

    .brand-title {
        font-size: 14px;
        font-weight: 800;
        line-height: 1;
        letter-spacing: .3px;
    }

    .brand-subtitle {
        margin-top: 3px;
        color: #777c99;
        font-size: 9px;
    }

    .top-pill {
        padding: 6px 12px;
        border: 1px solid rgba(139, 92, 246, .25);
        border-radius: 999px;
        background: rgba(20, 16, 45, .75);
        color: #aaa4d7;
        font-size: 10px;
        font-weight: 600;
    }

    .top-pill.highlight {
        color: #d8b4fe;
        border-color: rgba(168, 85, 247, .4);
    }

    .game-page {
        position: relative;
        z-index: 1;
        width: min(1180px, calc(100% - 32px));
        margin: 0 auto;
        padding: 30px 0 60px;
    }

    .game-layout {
        display: grid;
        grid-template-columns: minmax(0, 1fr) 290px;
        gap: 14px;
        align-items: start;
    }

    .main-panel,
    .side-panel {
        border: 1px solid rgba(100, 116, 139, .18);
        border-radius: 14px;
        background: rgba(8, 12, 27, .78);
        box-shadow:
            0 20px 70px rgba(0, 0, 0, .35),
            inset 0 1px 0 rgba(255, 255, 255, .025);
        backdrop-filter: blur(18px);
    }

    .main-panel {
        overflow: hidden;
    }

    .side-panel {
        overflow: hidden;
    }

    .room-header {
        padding: 20px 22px;
        border-bottom: 1px solid rgba(139, 92, 246, .14);
        background:
            linear-gradient(90deg,
                rgba(76, 29, 149, .12),
                rgba(8, 12, 27, .2));
    }

    .room-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .room-title {
        margin: 0;
        font-family: 'Cinzel', serif;
        font-size: 28px;
        font-weight: 800;
        letter-spacing: 1px;
    }

    .room-code {
        margin-top: 3px;
        color: #9b8fbd;
        font-size: 13px;
    }

    .difficulty-badge {
        padding: 6px 12px;
        border: 1px solid rgba(168, 85, 247, .35);
        border-radius: 999px;
        background: rgba(88, 28, 135, .18);
        color: #d8b4fe;
        font-size: 11px;
        font-weight: 700;
    }

    .content {
        padding: 18px;
    }

    .phase-banner {
        margin-bottom: 14px;
        padding: 16px;
        border: 1px solid rgba(168, 85, 247, .18);
        border-radius: 12px;
        background:
            linear-gradient(135deg,
                rgba(76, 29, 149, .18),
                rgba(15, 23, 42, .55));
    }

    .phase-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .phase-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .phase-icon {
        width: 40px;
        height: 40px;
        display: grid;
        place-items: center;
        border-radius: 10px;
        background: rgba(124, 58, 237, .2);
        border: 1px solid rgba(168, 85, 247, .2);
        color: #c084fc;
        font-size: 18px;
    }

    .phase-label {
        color: #8e91a9;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .8px;
    }

    .phase-title {
        margin-top: 2px;
        font-size: 20px;
        font-weight: 800;
    }

    .phase-round {
        color: #8589a3;
        font-size: 11px;
    }

    .timer-box {
        min-width: 85px;
        padding: 7px 12px;
        border: 1px solid rgba(168, 85, 247, .25);
        border-radius: 9px;
        background: rgba(3, 7, 18, .55);
        text-align: center;
    }

    .timer-label {
        color: #737891;
        font-size: 8px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .timer {
        margin-top: 1px;
        color: #d8b4fe;
        font-family: 'Cinzel', serif;
        font-size: 19px;
        font-weight: 800;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 14px;
    }

    .info-box {
        padding: 12px;
        border: 1px solid rgba(100, 116, 139, .14);
        border-radius: 10px;
        background: rgba(15, 23, 42, .5);
    }

    .info-label {
        color: #6f748d;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .info-value {
        margin-top: 3px;
        font-size: 14px;
        font-weight: 700;
    }

    .role-banner {
        margin-bottom: 16px;
        padding: 18px;
        border: 1px solid rgba(168, 85, 247, .28);
        border-radius: 12px;
        background:
            radial-gradient(circle at 50% 0,
                rgba(147, 51, 234, .2),
                transparent 55%),
            rgba(15, 23, 42, .7);
        text-align: center;
    }

    .role-label {
        color: #8589a3;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .role-name {
        margin-top: 2px;
        color: #d8b4fe;
        font-family: 'Kanit', sans-serif;
        font-size: 25px;
        font-weight: 700;
    }

    .section-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .section-title {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
    }

    .section-count {
        color: #777c99;
        font-size: 10px;
    }

    .players-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 9px;
    }

    .player-card {
        position: relative;
        min-height: 72px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px;
        border: 1px solid rgba(71, 85, 105, .2);
        border-radius: 10px;
        background:
            linear-gradient(135deg,
                rgba(15, 23, 42, .92),
                rgba(10, 14, 29, .72));
    }

    .player-card.you {
        border-color: rgba(168, 85, 247, .4);
        box-shadow: inset 2px 0 0 #a855f7;
    }

    .player-avatar {
        width: 40px;
        height: 40px;
        flex: 0 0 40px;
        display: grid;
        place-items: center;
        border-radius: 50%;
        background:
            linear-gradient(135deg,
                #4c1d95,
                #9333ea);
        color: white;
        font-size: 14px;
        font-weight: 800;
    }

    .player-card:nth-child(even) .player-avatar {
        background:
            linear-gradient(135deg,
                #172554,
                #2563eb);
    }

    .player-details {
        min-width: 0;
    }

    .player-name {
        overflow: hidden;
        color: #e8e8f2;
        font-size: 12px;
        font-weight: 700;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .player-status {
        margin-top: 2px;
        color: #6f748d;
        font-size: 9px;
    }

    .you-badge {
        color: #c084fc;
        font-size: 9px;
    }

    .dead {
        opacity: .45;
    }

    .left-player {
        opacity: .35;
    }

    .action-area {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 16px;
    }

    .btn-game {
        min-height: 38px;
        padding: 8px 17px;
        border: 0;
        border-radius: 9px;
        background:
            linear-gradient(135deg,
                #6d28d9,
                #a855f7);
        box-shadow: 0 8px 25px rgba(126, 34, 206, .22);
        color: white;
        font-family: 'Kanit', sans-serif;
        font-size: 12px;
        font-weight: 700;
    }

    .btn-game:hover {
        color: white;
        transform: translateY(-1px);
        background:
            linear-gradient(135deg,
                #7c3aed,
                #c084fc);
    }

    .btn-secondary-game {
        min-height: 38px;
        padding: 8px 17px;
        border: 1px solid rgba(148, 163, 184, .18);
        border-radius: 9px;
        background: rgba(15, 23, 42, .7);
        color: #b8bbca;
        font-family: 'Kanit', sans-serif;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-secondary-game:hover {
        color: white;
        border-color: rgba(168, 85, 247, .35);
    }

    .action-panel {
        margin-top: 14px;
        padding: 15px;
        border: 1px solid rgba(168, 85, 247, .16);
        border-radius: 11px;
        background: rgba(15, 23, 42, .45);
    }

    .action-title {
        margin-bottom: 10px;
        font-size: 14px;
        font-weight: 800;
    }

    .game-select {
        width: 100%;
        min-height: 40px;
        padding: 8px 12px;
        border: 1px solid rgba(100, 116, 139, .25);
        border-radius: 8px;
        outline: none;
        background: #0b1020;
        color: #e7e7ef;
        font-family: 'Kanit', sans-serif;
        font-size: 12px;
    }

    .game-select:focus {
        border-color: rgba(168, 85, 247, .55);
        box-shadow: 0 0 0 3px rgba(168, 85, 247, .08);
    }

    .game-select option {
        color: #111827;
    }

    .result-panel {
        margin-top: 14px;
        padding: 15px;
        border: 1px solid rgba(45, 212, 191, .14);
        border-radius: 11px;
        background: rgba(13, 148, 136, .06);
    }

    .result-title {
        margin-bottom: 7px;
        color: #99f6e4;
        font-size: 14px;
        font-weight: 800;
    }

    .winner-panel {
        margin-bottom: 15px;
        padding: 25px;
        border: 1px solid rgba(250, 204, 21, .22);
        border-radius: 12px;
        background:
            radial-gradient(circle at 50% 0,
                rgba(250, 204, 21, .14),
                transparent 60%),
            rgba(15, 23, 42, .7);
        text-align: center;
    }

    .winner-label {
        color: #99939f;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .winner-title {
        margin-top: 5px;
        color: #fde68a;
        font-family: 'Cinzel', serif;
        font-size: 28px;
        font-weight: 800;
    }

    .event-panel {
        margin-top: 14px;
        padding: 15px;
        border: 1px solid rgba(245, 158, 11, .18);
        border-radius: 11px;
        background: rgba(120, 53, 15, .08);
    }

    .event-title {
        color: #fbbf24;
        font-size: 14px;
        font-weight: 800;
    }

    .event-description {
        margin-top: 5px;
        color: #a7a8b8;
        font-size: 11px;
        line-height: 1.6;
    }

    .alert-game {
        margin-bottom: 12px;
        padding: 10px 12px;
        border: 1px solid rgba(168, 85, 247, .18);
        border-radius: 8px;
        background: rgba(88, 28, 135, .1);
        color: #b7accd;
        font-size: 11px;
    }

    .error-message {
        margin-bottom: 8px;
        padding: 10px 12px;
        border: 1px solid rgba(248, 113, 113, .2);
        border-radius: 8px;
        background: rgba(127, 29, 29, .12);
        color: #fca5a5;
        font-size: 11px;
    }

    .side-header {
        padding: 13px 14px;
        border-bottom: 1px solid rgba(100, 116, 139, .16);
    }

    .side-header-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .side-title {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 12px;
        font-weight: 800;
    }

    .online-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #22c55e;
        box-shadow: 0 0 10px rgba(34, 197, 94, .7);
    }

    .side-count {
        color: #777c99;
        font-size: 9px;
    }

    .side-content {
        padding: 13px;
    }

    .chat-message {
        margin-bottom: 9px;
        padding: 9px 10px;
        border: 1px solid rgba(100, 116, 139, .12);
        border-radius: 9px;
        background: rgba(15, 23, 42, .55);
        color: #aeb1c4;
        font-size: 10px;
        line-height: 1.5;
    }

    .chat-message.system {
        border-color: rgba(168, 85, 247, .13);
        background: rgba(76, 29, 149, .08);
    }


    .chat-toolbar {
        padding: 10px 13px;
        border-bottom: 1px solid rgba(100, 116, 139, .12);
        background: rgba(5, 8, 20, .35);
    }

    .chat-channels {
        display: flex;
        gap: 5px;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .chat-channels::-webkit-scrollbar {
        display: none;
    }

    .chat-channel {
        flex: 0 0 auto;
        padding: 5px 9px;
        border: 1px solid rgba(100, 116, 139, .18);
        border-radius: 999px;
        background: rgba(15, 23, 42, .55);
        color: #7f849b;
        font-family: 'Kanit', sans-serif;
        font-size: 9px;
        font-weight: 700;
        cursor: pointer;
    }

    .chat-channel:hover,
    .chat-channel.active {
        border-color: rgba(168, 85, 247, .35);
        background: rgba(76, 29, 149, .2);
        color: #d8b4fe;
    }

    .chat-channel.werewolf.active {
        border-color: rgba(239, 68, 68, .3);
        background: rgba(127, 29, 29, .15);
        color: #fca5a5;
    }

    .chat-channel.dead.active {
        border-color: rgba(148, 163, 184, .25);
        background: rgba(71, 85, 105, .16);
        color: #cbd5e1;
    }

    .chat-messages {
        height: 330px;
        overflow-y: auto;
        padding: 13px;
        scrollbar-width: thin;
        scrollbar-color: rgba(139, 92, 246, .25) transparent;
    }

    .chat-messages::-webkit-scrollbar {
        width: 4px;
    }

    .chat-messages::-webkit-scrollbar-thumb {
        border-radius: 999px;
        background: rgba(139, 92, 246, .25);
    }

    .chat-empty {
        min-height: 170px;
        display: grid;
        place-items: center;
        padding: 25px;
        color: #5e637b;
        font-size: 10px;
        text-align: center;
        line-height: 1.7;
    }

    .chat-message-row {
        margin-bottom: 10px;
    }

    .chat-message-row:last-child {
        margin-bottom: 0;
    }

    .chat-message-meta {
        display: flex;
        align-items: center;
        gap: 7px;
        margin-bottom: 3px;
        padding: 0 3px;
    }

    .chat-message-name {
        max-width: 155px;
        overflow: hidden;
        color: #c4b5fd;
        font-size: 9px;
        font-weight: 700;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .chat-message-time {
        color: #5e637b;
        font-size: 8px;
    }

    .chat-message-bubble {
        padding: 8px 10px;
        border: 1px solid rgba(100, 116, 139, .12);
        border-radius: 9px;
        background: rgba(15, 23, 42, .55);
        color: #c4c7d5;
        font-size: 10px;
        line-height: 1.55;
        overflow-wrap: anywhere;
        white-space: pre-wrap;
    }

    .chat-message-row.mine .chat-message-meta {
        justify-content: flex-end;
    }

    .chat-message-row.mine .chat-message-name {
        color: #d8b4fe;
    }

    .chat-message-row.mine .chat-message-bubble {
        border-color: rgba(168, 85, 247, .18);
        background: rgba(76, 29, 149, .14);
    }

    .chat-status {
        min-height: 22px;
        padding: 5px 13px 0;
        color: #686d85;
        font-size: 8px;
    }

    .chat-status.error {
        color: #fca5a5;
    }

    .chat-compose {
        padding: 10px 13px 13px;
        border-top: 1px solid rgba(100, 116, 139, .12);
        background: rgba(5, 8, 20, .25);
    }

    .chat-form {
        display: flex;
        gap: 7px;
    }

    .chat-input {
        min-width: 0;
        flex: 1;
        min-height: 36px;
        padding: 7px 10px;
        border: 1px solid rgba(100, 116, 139, .22);
        border-radius: 9px;
        outline: none;
        background: rgba(15, 23, 42, .72);
        color: #e7e7ef;
        font-family: 'Kanit', sans-serif;
        font-size: 10px;
    }

    .chat-input::placeholder {
        color: #5e637b;
    }

    .chat-input:focus {
        border-color: rgba(168, 85, 247, .45);
        box-shadow: 0 0 0 3px rgba(168, 85, 247, .07);
    }

    .chat-send {
        min-width: 52px;
        min-height: 36px;
        padding: 6px 10px;
        border: 0;
        border-radius: 9px;
        background: linear-gradient(135deg, #6d28d9, #a855f7);
        color: white;
        font-family: 'Kanit', sans-serif;
        font-size: 10px;
        font-weight: 700;
    }

    .chat-send:disabled {
        opacity: .45;
        cursor: not-allowed;
    }

    @media (max-width: 900px) {
        .side-panel {
            display: block;
        }

        .chat-messages {
            height: 280px;
        }
    }

    .side-placeholder {
        min-height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        color: #5e637b;
        font-size: 10px;
        text-align: center;
    }

    .footer-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-top: 14px;
    }

    .footer-link {
        color: #8b5cf6;
        font-size: 11px;
        text-decoration: none;
    }

    .footer-link:hover {
        color: #c084fc;
    }


    .section-card {
        margin-top: 14px;
    }

    .action-card {
        padding: 16px;
        border: 1px solid rgba(168, 85, 247, .16);
        border-radius: 11px;
        background: rgba(15, 23, 42, .45);
    }

    .action-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 14px;
    }

    .action-icon {
        width: 42px;
        height: 42px;
        display: grid;
        place-items: center;
        flex: 0 0 42px;
        border: 1px solid rgba(168, 85, 247, .2);
        border-radius: 11px;
        background: rgba(124, 58, 237, .14);
        font-size: 18px;
    }

    .action-description {
        margin-bottom: 12px;
        color: #8589a3;
        font-size: 11px;
        line-height: 1.6;
    }

    .form-group {
        margin-bottom: 12px;
    }

    .vote-button {
        width: 100%;
    }

    .game-alert.warning {
        border-color: rgba(245, 158, 11, .2);
        background: rgba(120, 53, 15, .1);
        color: #fcd34d;
    }

    .result-card {
        padding: 16px;
        border: 1px solid rgba(45, 212, 191, .14);
        border-radius: 11px;
        background: rgba(13, 148, 136, .06);
    }

    .result-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 14px;
    }

    .result-subtitle {
        margin-top: 3px;
        color: #6f748d;
        font-size: 10px;
    }

    .result-icon {
        width: 40px;
        height: 40px;
        display: grid;
        place-items: center;
        flex: 0 0 40px;
        border: 1px solid rgba(45, 212, 191, .14);
        border-radius: 10px;
        background: rgba(13, 148, 136, .08);
        font-size: 17px;
    }

    .result-player {
        padding: 12px;
        border: 1px solid rgba(100, 116, 139, .12);
        border-radius: 9px;
        background: rgba(15, 23, 42, .5);
    }

    .result-name {
        color: #e8e8f2;
        font-size: 14px;
        font-weight: 800;
    }

    .result-role {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-top: 9px;
        padding: 10px 12px;
        border-radius: 9px;
        background: rgba(45, 212, 191, .05);
    }

    .result-role-value {
        color: #99f6e4;
        font-size: 11px;
        font-weight: 700;
    }

    .footer-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    @media (max-width: 900px) {
        .game-layout {
            grid-template-columns: 1fr;
        }

        .side-panel {
            display: none;
        }
    }

    @media (max-width: 640px) {
        .game-page {
            width: min(100% - 18px, 1180px);
            padding-top: 15px;
        }

        .topbar {
            padding: 9px 12px;
        }

        .topbar-center {
            display: none;
        }

        .room-title {
            font-size: 21px;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .players-grid {
            grid-template-columns: 1fr;
        }

        .phase-row {
            align-items: flex-start;
            flex-direction: column;
        }

        .timer-box {
            width: 100%;
        }

        body::after {
            width: 48px;
            height: 48px;
            right: 4%;
        }
    }
    </style>
</head>

<body>

    <div class="smoke-wrapper">
        <div class="smoke-layer-1"></div>
        <div class="smoke-layer-2"></div>
    </div>

    {{-- top navigation --}}
    <header class="topbar">

        <div class="brand">
            <div class="brand-icon">🐺</div>

            <div>
                <div class="brand-title">
                    WEREWOLF ONLINE
                </div>

                <div class="brand-subtitle">
                    REAL-TIME SOCIAL DEDUCTION
                </div>
            </div>
        </div>

        <div>
            <a href="{{ route('games.show', ['code' => $game['room_code']]) }}" class="top-pill text-decoration-none">
                รีเฟรช
            </a>
        </div>

    </header>


    <main class="game-page">

        <div class="game-layout">

            {{-- main game area --}}
            <section class="main-panel">

                <div class="room-header">

                    <div class="room-header-row">

                        <div>
                            <h1 class="room-title">
                                WAREWOLF
                            </h1>

                            <div class="room-code">
                                ห้อง {{ $game['room_code'] }}
                            </div>
                        </div>

                        <div class="difficulty-badge">
                            {{ $game['difficulty'] === 'easy' ? 'EASY' : 'HARD' }}
                        </div>

                    </div>

                </div>


                <div class="content">

                    {{-- errors --}}
                    @foreach ($errors->all() as $error)
                    <div class="error-message">
                        {{ $error }}
                    </div>
                    @endforeach


                    {{-- success --}}
                    @if (session('success'))
                    <div class="alert-game">
                        {{ session('success') }}
                    </div>
                    @endif


                    {{-- phase --}}
                    <div class="phase-banner">

                        <div class="phase-row">

                            <div class="phase-info">

                                <div class="phase-icon">
                                    @if ($game['current_phase'] === 'night')
                                    🌙
                                    @elseif ($game['current_phase'] === 'day_voting')
                                    ⚔
                                    @else
                                    ☀
                                    @endif
                                </div>

                                <div>

                                    <div class="phase-label">
                                        @if ($game['current_phase'] === 'night')
                                        NIGHT PHASE
                                        @elseif ($game['current_phase'] === 'day_voting')
                                        VOTING PHASE
                                        @elseif ($game['current_phase'] === 'day_discussion')
                                        DISCUSSION PHASE
                                        @else
                                        GAME STATUS
                                        @endif
                                    </div>

                                    <div class="phase-title">

                                        @if ($game['current_phase'] === 'night')
                                        ช่วงกลางคืน
                                        @elseif ($game['current_phase'] === 'day_voting')
                                        ช่วงโหวต
                                        @elseif ($game['current_phase'] === 'day_discussion')
                                        ช่วงพูดคุย
                                        @elseif ($game['status'] === 'roles_assigned')
                                        รอเริ่มเกม
                                        @elseif ($game['status'] === 'initializing')
                                        กำลังเตรียมเกม
                                        @else
                                        {{ $game['status'] }}
                                        @endif

                                    </div>

                                    @if (
                                    in_array(
                                    $game['current_phase'],
                                    ['day_discussion', 'day_voting', 'night'],
                                    true
                                    )
                                    )
                                    <div class="phase-round">
                                        รอบ {{ $game['current_round'] }}
                                    </div>
                                    @endif

                                </div>

                            </div>


                            @if ($game['phase_end_time'] !== null)
                            <div class="timer-box">

                                <div class="timer-label">
                                    TIME
                                </div>

                                <div id="phase-timer" class="timer">
                                    --:--
                                </div>

                            </div>
                            @endif

                        </div>

                    </div>


                    {{-- game information --}}
                    <div class="info-grid">

                        <div class="info-box">
                            <div class="info-label">
                                Status
                            </div>

                            <div class="info-value">
                                @if ($game['status'] === 'roles_assigned')
                                แจกบทบาทแล้ว
                                @elseif ($game['status'] === 'initializing')
                                กำลังเตรียมเกม
                                @else
                                {{ $game['status'] }}
                                @endif
                            </div>
                        </div>


                        <div class="info-box">
                            <div class="info-label">
                                Players
                            </div>

                            <div class="info-value">
                                {{ count($game['players']) }}
                            </div>
                        </div>


                        <div class="info-box">
                            <div class="info-label">
                                Difficulty
                            </div>

                            <div class="info-value">
                                {{ $game['difficulty'] === 'easy' ? 'ง่าย' : 'ยาก' }}
                            </div>
                        </div>

                    </div>


                    @php
                    $roleLabels = [
                    'werewolf' => 'หมาป่า',
                    'seer' => 'ผู้หยั่งรู้',
                    'villager' => 'ชาวบ้าน',
                    ];
                    @endphp


                    {{-- player role --}}
                    @if ($game['my_role'] !== null)

                    <div class="role-banner">

                        <div class="role-label">
                            YOUR ROLE
                        </div>

                        <div class="role-name">
                            {{ $roleLabels[$game['my_role']] ?? 'ไม่ทราบบทบาท' }}
                        </div>

                    </div>

                    @endif


                    {{-- werewolf teammates --}}
                    @if ($game['my_role'] === 'werewolf')

                    <div class="action-panel mb-3">

                        <div class="action-title">
                            หมาป่าร่วมทีม
                        </div>

                        @forelse ($game['werewolf_teammates'] as $teammate)

                        <div class="player-card mb-2">

                            <div class="player-avatar">
                                {{ mb_substr($teammate['name'], 0, 1) }}
                            </div>

                            <div class="player-details">

                                <div class="player-name">
                                    {{ $teammate['name'] }}
                                </div>

                                <div class="player-status">

                                    @if ($teammate['has_left'])
                                    ออกจากเกมแล้ว
                                    @elseif (!$teammate['is_alive'])
                                    เสียชีวิต
                                    @else
                                    มีชีวิต
                                    @endif

                                </div>

                            </div>

                        </div>

                        @empty

                        <div class="alert-game">
                            คุณเป็นหมาป่าเพียงคนเดียว
                        </div>

                        @endforelse

                    </div>

                    @endif


                    {{-- players --}}
                    <div class="section-heading">

                        <h2 class="section-title">
                            ผู้เล่น
                        </h2>

                        <div class="section-count">
                            {{ count($game['players']) }} Players
                        </div>

                    </div>


                    <div class="players-grid">

                        @foreach ($game['players'] as $player)

                        @php
                        $playerClass = '';

                        if ($player['has_left']) {
                        $playerClass = 'left-player';
                        } elseif (!$player['is_alive']) {
                        $playerClass = 'dead';
                        }

                        $isCurrentPlayer =
                        $player['player_uuid'] === session('player_uuid');
                        @endphp

                        <div class="player-card {{ $playerClass }} {{ $isCurrentPlayer ? 'you' : '' }}">

                            <div class="player-avatar">
                                {{ mb_substr($player['name'], 0, 1) }}
                            </div>

                            <div class="player-details">

                                <div class="player-name">

                                    {{ $player['name'] }}

                                    @if ($isCurrentPlayer)
                                    <span class="you-badge">
                                        (คุณ)
                                    </span>
                                    @endif

                                </div>

                                <div class="player-status">

                                    @if ($player['has_left'])
                                    ออกจากเกมแล้ว
                                    @elseif (!$player['is_alive'])
                                    เสียชีวิต
                                    @else
                                    มีชีวิต
                                    @endif

                                </div>

                            </div>

                        </div>

                        @endforeach

                    </div>


                    {{-- start discussion --}}
                    @if ($game['can_begin_discussion'])

                    <div class="action-area">

                        <form method="POST" action="{{ route('games.begin-discussion', [
                                    'code' => $game['room_code'],
                                ]) }}">
                            @csrf

                            <button type="submit" class="btn-game">
                                เริ่มช่วงพูดคุย
                            </button>

                        </form>

                    </div>

                    @endif


                    {{-- day voting --}}
                    @if ($game['current_phase'] === 'day_voting')

                    <div class="section-card">

                        <div class="action-card">

                            <div class="action-header">
                                <div>
                                    <div class="action-title">
                                        ช่วงโหวต — รอบ {{ $game['current_round'] }}
                                    </div>
                                    <div class="phase-round">
                                        การโหวตครั้งที่ {{ $game['ballot_number'] }}
                                    </div>
                                </div>

                                <div class="action-icon">🗳️</div>
                            </div>

                            @if ($game['ballot_number'] === 2)
                            <div class="alert-game warning">
                                คะแนนครั้งแรกเสมอ จึงเปิดโหวตใหม่อีก 1 ครั้ง
                            </div>
                            @endif

                            @if ($game['can_vote'])

                            <form method="POST" action="{{ route('games.vote', [
                                'code' => $game['room_code'],
                            ]) }}">

                                @csrf

                                <input type="hidden" name="expected_end_time" value="{{ $game['phase_end_time'] }}">

                                <div class="action-description">
                                    เลือกผู้เล่นที่คุณต้องการโหวตออก
                                </div>

                                <div class="form-group">
                                    <label class="info-label">
                                        เลือกผู้เล่นที่ต้องการโหวต
                                    </label>

                                    <select name="target_uuid" class="game-select" required>
                                        <option value="">เลือกผู้เล่น</option>

                                        @foreach ($game['players'] as $player)
                                        @if ($player['is_alive'] && !$player['has_left'])
                                        <option value="{{ $player['player_uuid'] }}" @selected(
                                            $game['my_vote']===$player['player_uuid'] )>
                                            {{ $player['name'] }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn-game vote-button">
                                    ยืนยันโหวต
                                </button>

                            </form>

                            @else

                            <div class="alert-game">
                                ตอนนี้คุณไม่สามารถโหวตได้
                            </div>

                            @endif

                        </div>

                    </div>

                    @endif


                    {{-- vote result --}}
                    @if ($game['vote_result'] !== null)

                    <div class="section-card">

                        <div class="result-card">

                            <div class="result-header">
                                <div>
                                    <div class="result-title">
                                        ผลโหวตรอบ {{ $game['vote_result']['round'] }}
                                    </div>
                                    <div class="result-subtitle">
                                        ผลการลงคะแนนของผู้เล่นในรอบนี้
                                    </div>
                                </div>

                                <div class="result-icon">⚖️</div>
                            </div>

                            @if ($game['vote_result']['name'] !== null)

                            <div class="result-player">
                                <div class="info-label">ผู้ถูกโหวตออก</div>
                                <div class="result-name">
                                    {{ $game['vote_result']['name'] }}
                                </div>
                            </div>

                            @if (isset($game['vote_result']['role']))
                            <div class="result-role">
                                <span class="info-label mb-0">บทบาท</span>
                                <span class="result-role-value">
                                    {{ $roleLabels[$game['vote_result']['role']] }}
                                </span>
                            </div>
                            @endif

                            @else

                            <div class="alert-game">
                                ไม่มีผู้ถูกโหวตออก
                            </div>

                            @endif

                        </div>

                    </div>

                    @endif


                    {{-- winner --}}
                    @if ($game['winner'] !== null)

                    <div class="winner-panel">

                        <div class="winner-label">
                            MATCH SUMMARY
                        </div>

                        <div class="winner-title">

                            {{ $game['winner'] === 'werewolf'
                                    ? 'ทีมหมาป่าชนะ'
                                    : 'ทีมชาวบ้านชนะ' }}

                        </div>

                    </div>

                    @endif


                    {{-- finish discussion --}}
                    @if (
                    $game['current_phase'] === 'day_discussion'
                    && $game['phase_end_time'] !== null
                    )

                    <div class="action-area">

                        <form id="finish-discussion-form" method="POST" action="{{ route('games.finish-discussion', [
                                    'code' => $game['room_code'],
                                ]) }}">

                            @csrf

                            <input type="hidden" name="expected_end_time" value="{{ $game['phase_end_time'] }}">

                            <button type="submit" class="btn-game">
                                ตรวจเวลาจบช่วงพูดคุย
                            </button>

                        </form>

                    </div>

                    @endif


                    {{-- finish voting --}}
                    @if (
                    $game['current_phase'] === 'day_voting'
                    && $game['phase_end_time'] !== null
                    )

                    <div class="action-area">

                        <form id="finish-voting-form" method="POST" action="{{ route('games.finish-voting', [
                                    'code' => $game['room_code'],
                                ]) }}">

                            @csrf

                            <input type="hidden" name="expected_end_time" value="{{ $game['phase_end_time'] }}">

                            <button type="submit" class="btn-secondary-game">
                                ตรวจเวลาจบช่วงโหวต
                            </button>

                        </form>

                    </div>

                    @endif


                    {{-- night --}}
                    @if ($game['current_phase'] === 'night')

                    <div class="section-card">

                        <div class="action-card">

                            <div class="action-header">
                                <div>
                                    <div class="action-title">
                                        🌙 ช่วงกลางคืน
                                    </div>
                                    <div class="phase-round">
                                        ใช้ความสามารถของบทบาทคุณในช่วงกลางคืน
                                    </div>
                                </div>

                                <div class="action-icon">🌙</div>
                            </div>

                            @if ($game['can_werewolf_act'])

                            <form method="POST" action="{{ route('games.werewolf-action', [
                                        'code' => $game['room_code'],
                                    ]) }}">

                                @csrf

                                <input type="hidden" name="expected_end_time" value="{{ $game['phase_end_time'] }}">

                                <div class="mb-2">

                                    <label class="info-label">
                                        เลือกเป้าหมายคืนนี้
                                    </label>

                                    <select name="target_uuid" class="game-select" required>

                                        <option value="">
                                            เลือกผู้เล่น
                                        </option>

                                        @foreach ($game['werewolf_targets'] as $target)

                                        <option value="{{ $target['player_uuid'] }}" @selected(
                                            $game['my_night_target']===$target['player_uuid'] )>
                                            {{ $target['name'] }}
                                        </option>

                                        @endforeach

                                    </select>

                                </div>

                                <button type="submit" class="btn-game">
                                    ยืนยันเป้าหมาย
                                </button>

                            </form>

                            @endif


                            @if ($game['my_role'] === 'seer')

                            <div class="mt-3">

                                <div class="phase-round mb-2">
                                    ใช้สิทธิ์ตรวจแล้ว
                                    {{ $game['my_seer_checks_used'] }}
                                    ครั้ง /
                                    {{ $game['my_seer_checks_limit'] ?? 'ไม่จำกัด' }}
                                </div>

                            </div>

                            @endif


                            @if ($game['can_seer_act'])

                            <form method="POST" action="{{ route('games.seer-action', [
                                        'code' => $game['room_code'],
                                    ]) }}">

                                @csrf

                                <input type="hidden" name="expected_end_time" value="{{ $game['phase_end_time'] }}">

                                <div class="mb-2">

                                    <label class="info-label">
                                        เลือกผู้เล่นที่จะตรวจ
                                    </label>

                                    <select name="target_uuid" class="game-select" required>

                                        <option value="">
                                            เลือกผู้เล่น
                                        </option>

                                        @foreach ($game['seer_targets'] as $target)

                                        <option value="{{ $target['player_uuid'] }}" @selected(
                                            $game['my_night_target']===$target['player_uuid'] )>
                                            {{ $target['name'] }}
                                        </option>

                                        @endforeach

                                    </select>

                                </div>

                                <button type="submit" class="btn-game">
                                    ยืนยันการตรวจ
                                </button>

                            </form>

                            @endif

                        </div>

                    </div>

                    @endif


                    {{-- night result --}}
                    @if ($game['night_result'] !== null)

                    <div class="result-panel">

                        <div class="result-title">
                            ผลกลางคืนรอบ {{ $game['night_result']['round'] }}
                        </div>

                        @if ($game['night_result']['name'] !== null)

                        <div>
                            ผู้เสียชีวิต:
                            <strong>
                                {{ $game['night_result']['name'] }}
                            </strong>
                        </div>

                        @if (isset($game['night_result']['role']))

                        <div class="phase-round mt-1">
                            บทบาท:
                            {{ $roleLabels[$game['night_result']['role']] }}
                        </div>

                        @endif

                        @else

                        <div>
                            คืนนี้ไม่มีผู้เสียชีวิตจากหมาป่า
                        </div>

                        @endif

                    </div>

                    @endif


                    {{-- seer results --}}
                    @if ($game['my_role'] === 'seer')

                    <div class="action-panel">

                        <div class="action-title">
                            ผลตรวจของคุณ
                        </div>

                        @forelse ($game['my_seer_results'] as $result)

                        <div class="player-card mb-2">

                            <div class="player-avatar">
                                🔎
                            </div>

                            <div class="player-details">

                                <div class="player-name">
                                    รอบ {{ $result['round'] }}
                                </div>

                                <div class="player-status">
                                    {{ $result['target_name'] }}
                                    —
                                    {{ $result['is_werewolf']
                                                ? 'เป็นหมาป่า'
                                                : 'ไม่ใช่หมาป่า' }}
                                </div>

                            </div>

                        </div>

                        @empty

                        <div class="phase-round">
                            ยังไม่มีผลตรวจ
                        </div>

                        @endforelse

                    </div>

                    @endif


                    {{-- finish night --}}
                    @if (
                    $game['status'] === 'in_progress'
                    && $game['current_phase'] === 'night'
                    && $game['phase_end_time'] !== null
                    )

                    <div class="action-area">

                        <form id="finish-night-form" method="POST" action="{{ route('games.finish-night', [
                                    'code' => $game['room_code'],
                                ]) }}">

                            @csrf

                            <input type="hidden" name="expected_end_time" value="{{ $game['phase_end_time'] }}">

                            <button type="submit" class="btn-secondary-game">
                                ตรวจเวลาจบกลางคืน
                            </button>

                        </form>

                    </div>

                    @endif


                    {{-- night event --}}
                    @if (
                    $game['current_phase'] === 'night'
                    && $game['night_event'] !== null
                    )

                    <div class="event-panel">

                        <div class="event-title">
                            Event จากคืนรอบ
                            {{ $game['night_event']['night_round'] }}
                        </div>

                        <div class="event-description">

                            <strong>
                                {{ $game['night_event']['name'] }}
                            </strong>

                            @if ($game['night_event']['id'] !== 'none')

                            <br>

                            {{ $game['night_event']['description'] }}

                            <br><br>

                            สำหรับกลางวันรอบ
                            {{ $game['night_event']['applies_to_round'] }}

                            <br><br>

                            กำลังทดสอบประกาศ Event —
                            ผลจะเริ่มในกลางวันถัดไป
                            โดยโอกาสลงคะแนนใหม่ยังอยู่ระหว่างเชื่อมระบบ

                            @endif

                        </div>

                    </div>

                    @endif


                    {{-- day event --}}
                    @if (
                    in_array(
                    $game['current_phase'],
                    ['day_discussion', 'day_voting'],
                    true
                    )
                    && $game['day_event'] !== null
                    && $game['day_event']['id'] !== 'none'
                    )

                    <div class="event-panel">

                        <div class="event-title">
                            Event กลางวันรอบ
                            {{ $game['day_event']['round'] }}
                        </div>

                        <div class="event-description">

                            <strong>
                                {{ $game['day_event']['name'] }}
                            </strong>

                            <br>

                            @if ($game['day_event']['applied'])

                            {{ $game['day_event']['description'] }}

                            <br><br>

                            มีผลในกลางวันรอบนี้

                            @else

                            Event นี้ยังไม่เปิดใช้ —
                            รอบนี้ใช้กติกาพื้นฐาน

                            @endif

                        </div>

                    </div>

                    @endif


                    {{-- leave game --}}
                    <div class="footer-actions">

                        <form method="POST" action="{{ route('games.leave', [
                                'code' => $game['room_code'],
                            ]) }}" onsubmit="return confirm('ออกถาวรจากเกมนี้? คุณจะกลับเข้าห้องเดิมไม่ได้');">

                            @csrf

                            <div class="footer-actions">
                                <button type="submit" class="btn-secondary-game">
                                    ออกจากเกมถาวร
                                </button>
                            </div>

                        </form>

                    </div>

                </div>

            </section>


            {{-- side panel --}}
            @php
            $currentPlayer = collect($game['players'])->first(
            fn ($player) => ($player['player_uuid'] ?? null) === session('player_uuid')
            );

            $canUseDeadChat =
            $currentPlayer !== null
            && !$currentPlayer['is_alive']
            && !$currentPlayer['has_left'];

            $canUseWerewolfChat =
            $game['my_role'] === 'werewolf'
            && $currentPlayer !== null
            && $currentPlayer['is_alive']
            && !$currentPlayer['has_left'];
            @endphp

            <aside class="side-panel" id="chat-panel" data-chat-url="" data-chat-store-url=""
                data-player-name="{{ $currentPlayer['name'] ?? '' }}">

                <div class="side-header">

                    <div class="side-header-row">

                        <div class="side-title">
                            <span class="online-dot"></span>
                            LIVE CHAT
                        </div>

                        <div class="side-count">
                            {{ count($game['players']) }} คน
                        </div>

                    </div>

                </div>


                <div class="chat-toolbar">

                    <div class="chat-channels">

                        <button type="button" class="chat-channel active" data-chat-channel="all">
                            ALL
                        </button>

                        @if ($canUseWerewolfChat)
                        <button type="button" class="chat-channel werewolf" data-chat-channel="werewolf">
                            🐺 WEREWOLF
                        </button>
                        @endif

                        @if ($canUseDeadChat)
                        <button type="button" class="chat-channel dead" data-chat-channel="dead">
                            💀 DEAD
                        </button>
                        @endif

                    </div>

                </div>


                <div id="chat-messages" class="chat-messages" aria-live="polite">

                    <div class="chat-empty">
                        กำลังโหลดข้อความ...
                    </div>

                </div>


                <div id="chat-status" class="chat-status">
                    กำลังเชื่อมต่อห้องแชต...
                </div>


                <div class="chat-compose">

                    <form id="chat-form" class="chat-form">

                        <input id="chat-input" class="chat-input" type="text" name="message" maxlength="500"
                            autocomplete="off" placeholder="พิมพ์ข้อความ...">

                        <button id="chat-send" class="chat-send" type="submit">
                            ส่ง
                        </button>

                    </form>

                </div>

            </aside>

        </div>

    </main>



    {{-- chat --}}
    <script>
    (() => {
        const chatPanel = document.getElementById('chat-panel');

        if (!chatPanel) {
            return;
        }

        const chatMessages = document.getElementById('chat-messages');
        const chatStatus = document.getElementById('chat-status');
        const chatForm = document.getElementById('chat-form');
        const chatInput = document.getElementById('chat-input');
        const chatSend = document.getElementById('chat-send');
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute('content');

        const chatUrl = chatPanel.dataset.chatUrl;
        const chatStoreUrl = chatPanel.dataset.chatStoreUrl;
        const currentPlayerName = chatPanel.dataset.playerName;

        let currentChannel = 'all';
        let isLoading = false;
        let isSending = false;
        let pollTimer = null;

        function setStatus(message, isError = false) {
            chatStatus.textContent = message;
            chatStatus.classList.toggle('error', isError);
        }

        function isNearBottom() {
            return (
                chatMessages.scrollHeight -
                chatMessages.scrollTop -
                chatMessages.clientHeight
            ) < 80;
        }

        function scrollToBottom() {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function formatTime(value) {
            if (!value) {
                return '';
            }

            const date = new Date(value);

            if (Number.isNaN(date.getTime())) {
                return '';
            }

            return date.toLocaleTimeString('th-TH', {
                hour: '2-digit',
                minute: '2-digit',
            });
        }

        function renderMessages(messages) {
            const shouldScroll = isNearBottom();

            chatMessages.replaceChildren();

            if (!messages.length) {
                const empty = document.createElement('div');
                empty.className = 'chat-empty';
                empty.textContent =
                    'ยังไม่มีข้อความในช่องนี้\\nเริ่มบทสนทนาได้เลย';
                chatMessages.appendChild(empty);
                return;
            }

            messages.forEach((item) => {
                const row = document.createElement('div');
                row.className = 'chat-message-row';

                if (
                    item.sender &&
                    item.sender.name === currentPlayerName
                ) {
                    row.classList.add('mine');
                }

                const meta = document.createElement('div');
                meta.className = 'chat-message-meta';

                const name = document.createElement('span');
                name.className = 'chat-message-name';
                name.textContent = item.sender?.name ?? 'ผู้เล่น';

                const time = document.createElement('span');
                time.className = 'chat-message-time';
                time.textContent = formatTime(item.created_at);

                meta.appendChild(name);
                meta.appendChild(time);

                const bubble = document.createElement('div');
                bubble.className = 'chat-message-bubble';

                // use textContent so chat messages cannot inject HTML
                bubble.textContent = item.message ?? '';

                row.appendChild(meta);
                row.appendChild(bubble);
                chatMessages.appendChild(row);
            });

            if (shouldScroll) {
                scrollToBottom();
            }
        }

        async function loadMessages() {
            if (isLoading) {
                return;
            }

            isLoading = true;

            try {

                if (chatUrl === '') {
                    return;
                }

                const url =
                    `${chatUrl}?channel=${encodeURIComponent(currentChannel)}`;

                if (chatStoreUrl === '') {
                    return;
                }

                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                    },
                    cache: 'no-store',
                });

                if (!response.ok) {
                    throw new Error(
                        `โหลดแชตไม่สำเร็จ (${response.status})`
                    );
                }

                const data = await response.json();

                renderMessages(
                    Array.isArray(data.messages) ?
                    data.messages : []
                );

                setStatus(
                    `ช่อง ${currentChannel.toUpperCase()}`
                );
            } catch (error) {
                setStatus(
                    error.message || 'โหลดแชตไม่สำเร็จ',
                    true
                );
            } finally {
                isLoading = false;
            }
        }

        async function sendMessage(message) {
            if (isSending) {
                return;
            }

            isSending = true;
            chatSend.disabled = true;

            try {
                const body = new URLSearchParams();

                body.set('channel', currentChannel);
                body.set('message', message);

                const response = await fetch(
                    chatStoreUrl, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body,
                    }
                );

                const data = await response.json();

                if (!response.ok) {
                    const validationMessage =
                        data?.errors?.message?. [0];

                    throw new Error(
                        validationMessage ||
                        data?.message ||
                        `ส่งข้อความไม่สำเร็จ (${response.status})`
                    );
                }

                chatInput.value = '';

                await loadMessages();

                chatInput.focus();
            } catch (error) {
                setStatus(
                    error.message || 'ส่งข้อความไม่สำเร็จ',
                    true
                );
            } finally {
                isSending = false;
                chatSend.disabled = false;
            }
        }

        document
            .querySelectorAll('[data-chat-channel]')
            .forEach((button) => {
                button.addEventListener('click', () => {
                    const channel =
                        button.dataset.chatChannel;

                    if (!channel || channel === currentChannel) {
                        return;
                    }

                    currentChannel = channel;

                    document
                        .querySelectorAll('[data-chat-channel]')
                        .forEach((item) => {
                            item.classList.toggle(
                                'active',
                                item.dataset.chatChannel === channel
                            );
                        });

                    loadMessages();
                });
            });

        chatForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const message = chatInput.value.trim();

            if (message === '') {
                chatInput.focus();
                return;
            }

            sendMessage(message);
        });

        loadMessages();

        pollTimer = setInterval(
            loadMessages,
            2500
        );

        window.addEventListener('beforeunload', () => {
            if (pollTimer !== null) {
                clearInterval(pollTimer);
            }
        });
    })();
    </script>

    {{-- timer --}}
    @if ($game['phase_end_time'] !== null)

    <script>
    const timerElement =
        document.getElementById('phase-timer');

    if (timerElement) {

        const endTime = Date.parse(
            @json($game['phase_end_time'])
        );

        const serverTime = Date.parse(
            @json($game['server_time'])
        );

        const loadedAt = performance.now();

        let timerInterval;


        function updateTimer() {

            const elapsed =
                performance.now() - loadedAt;

            const estimatedServerTime =
                serverTime + elapsed;

            const secondsLeft =
                Math.max(
                    0,
                    Math.ceil(
                        (endTime - estimatedServerTime) / 1000
                    )
                );


            if (secondsLeft === 0) {

                clearInterval(timerInterval);

                const form =
                    document.getElementById(
                        'finish-discussion-form'
                    ) ??
                    document.getElementById(
                        'finish-voting-form'
                    ) ??
                    document.getElementById(
                        'finish-night-form'
                    );


                if (form) {

                    timerElement.textContent =
                        'หมดเวลา';

                    form.requestSubmit();

                } else {

                    timerElement.textContent =
                        'หมดเวลา';

                }

                return;
            }


            const minutes =
                Math.floor(secondsLeft / 60);

            const seconds =
                String(
                    secondsLeft % 60
                ).padStart(2, '0');


            timerElement.textContent =
                `${minutes}:${seconds}`;
        }


        timerInterval =
            setInterval(
                updateTimer,
                250
            );

        updateTimer();
    }
    </script>

    @endif

</body>

</html>