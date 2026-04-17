<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hunger Hub Logo</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: linear-gradient(135deg, #fff7ed, #ffe4e6);
      font-family: 'Poppins', sans-serif;
    }
    .logo {
      display: flex;
      align-items: center;
      gap: 15px;
      animation: fadeIn 1.5s ease-in-out;
    }
    .icon {
      width: 70px;
      height: 70px;
      background: #ef4444;
      border-radius: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      box-shadow: 0 6px 15px rgba(239,68,68,0.5);
      transform: scale(0.9);
      animation: bounce 2s infinite;
    }
    .icon svg {
      width: 36px;
      height: 36px;
      stroke: #fff;
      animation: pulse 2s infinite;
    }
    .text h1 {
      font-size: 36px;
      font-weight: bold;
      color: #dc2626;
      margin: 0;
      letter-spacing: 1px;
      animation: slideIn 1.5s ease-in-out;
    }
    .text h1 span {
      color: #facc15;
    }
    .text p {
      margin: 0;
      font-size: 14px;
      color: #6b7280;
      animation: fadeIn 2s ease-in-out;
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    @keyframes slideIn {
      from { transform: translateX(-50px); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }
    @keyframes bounce {
      0%, 100% { transform: translateY(0) scale(0.95); }
      50% { transform: translateY(-10px) scale(1); }
    }
    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.2); opacity: 0.7; }
    }
  </style>
</head>
<body>
  <div class="logo">
    <div class="icon">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M10 14h10M10 18h10" />
      </svg>
    </div>
    <div class="text">
      <h1>Hunger<span>Hub</span></h1>
      <p>Your Food, Your Way</p>
    </div>
  </div>
</body>
</html>
