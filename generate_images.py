from PIL import Image, ImageDraw, ImageFont
from datetime import datetime, timezone, timedelta
import os

def create_frame(width, height, remaining_time, bg_color="#9B2642", text_color="#FFFFFF"):
    # Create image
    image = Image.new('RGB', (width, height), bg_color)
    draw = ImageDraw.Draw(image)
    
    # Calculate time units
    days = remaining_time.days
    hours = (remaining_time.seconds // 3600)
    minutes = ((remaining_time.seconds % 3600) // 60)
    seconds = (remaining_time.seconds % 60)
    
    # Create text
    text = f"{days}d {hours:02d}h {minutes:02d}m {seconds:02d}s"
    
    # Use default font
    try:
        font = ImageFont.truetype("/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf", 36)
    except:
        font = ImageFont.load_default()

    # Get text size and center it
    bbox = draw.textbbox((0, 0), text, font=font)
    text_width = bbox[2] - bbox[0]
    text_height = bbox[3] - bbox[1]
    x = (width - text_width) // 2
    y = (height - text_height) // 2
    
    # Draw text
    draw.text((x, y), text, font=font, fill=text_color)
    
    return image

def main():
    # Create docs directory if it doesn't exist
    os.makedirs('docs', exist_ok=True)
    
    # Target date (Jan 28, 2025 11:00 AM EST)
    target = datetime(2025, 1, 28, 11, 0, tzinfo=timezone(timedelta(hours=-5)))
    now = datetime.now(timezone(timedelta(hours=-5)))
    
    # Calculate remaining time
    remaining = target - now
    
    # Create timer image
    image = create_frame(400, 100, remaining)
    
    # Save the image
    image.save('docs/timer.png')
    
    # Create simple HTML page
    html_content = f"""<!DOCTYPE html>
<html>
<head>
    <title>Countdown Timer</title>
    <meta http-equiv="refresh" content="60">
</head>
<body style="margin:0;padding:0;display:flex;justify-content:center;align-items:center;min-height:100vh;background:#9B2642;">
    <img src="timer.png" alt="Time Remaining" style="max-width:100%;height:auto;">
</body>
</html>"""
    
    with open('docs/index.html', 'w') as f:
        f.write(html_content)

if __name__ == "__main__":
    main()