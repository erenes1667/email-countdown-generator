# Email Countdown Timer Generator

A simple, free countdown timer generator for email marketing campaigns. No watermarks, no external dependencies.

## Features

- Real-time countdown updates when email is opened
- Custom brand color (#9B2642)
- No watermarks or branding
- Mobile responsive
- Works in all email clients that support images

## Usage

1. Upload `countdown.php` to your web server
2. Add this HTML to your email:

```html
<div style="text-align: center;">
    <img src="https://your-domain.com/countdown.php" alt="Time Remaining" style="max-width: 100%; height: auto;">
</div>
```

3. Replace `your-domain.com` with your actual domain

## Requirements

- PHP server with GD library enabled (most hosts have this by default)
- Web hosting that supports PHP

## Customization

To modify the countdown target date, edit line 8 in countdown.php:

```php
$target = strtotime('2025-01-28 11:00:00 America/New_York');
```

To change colors or dimensions, modify the relevant variables at the top of the script.

## License

MIT License - feel free to use in any project