<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Contacting Us</title>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #fff; color: #333;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #fce4ec; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
                    <tr>
                        <td style="background-color: #ec407a; padding: 20px; text-align: center;">
                            <h1 style="margin: 0; color: #fff; font-size: 24px;">Thank You for Contacting Us!</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px;">
                            <p style="font-size: 16px;"><strong>Dear {{ $data['name'] }},</strong></p>

                            <p style="font-size: 15px; color: #555;">
                                We have received your message and will get back to you as soon as possible.
                                Below is a copy of your inquiry for your records:
                            </p>

                            <h3 style="color: #ec407a;">Your Submitted Details:</h3>
                            <ul style="list-style: none; padding-left: 0; color: #555; font-size: 15px;">
                                <li><strong>Name:</strong> {{ $data['name'] }}</li>
                                <li><strong>Email:</strong> {{ $data['email'] }}</li>
                                <li><strong>Phone:</strong> {{ $data['phone'] }}</li>
                                <li><strong>Message:</strong> {{ $data['message'] }}</li>
                            </ul>

                            <p style="font-size: 15px; color: #555;">
                                Thank you again for reaching out to <strong>Shanana Beauty and Bedroom
                                    Products</strong>.
                                We appreciate your interest and will respond shortly.
                            </p>

                            <p style="font-size: 15px;">Warm regards,<br><strong>The Shanana Team</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="background-color: #f8bbd0; text-align: center; padding: 15px; font-size: 13px; color: #555;">
                            &copy; {{ date('Y') }} Shanana Beauty Products. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>
