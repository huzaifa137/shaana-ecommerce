<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Shanana Beauty and Bedroom Products</title>
</head>

<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #fff; color: #333;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #fce4ec; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
                    <tr>
                        <td style="background-color: #ec407a; padding: 20px; text-align: center;">
                            <h1 style="margin: 0; color: #fff; font-size: 24px;">Welcome to Shanana Beauty Products!
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px;">
                            <p style="font-size: 16px; color: #333;"><strong>Dear {{ $first_name }}
                                    {{ $last_name }},</strong></p>

                            <p style="font-size: 15px; color: #555;">
                                We are thrilled to inform you that your account has been successfully created on
                                <strong>Shanana Beauty and Bedroom Products!</strong> Welcome aboard!
                            </p>

                            <h3 style="color: #ec407a;">Your Account Details:</h3>
                            <ul style="list-style: none; padding-left: 0; color: #555; font-size: 15px;">
                                <li><strong>Firstname:</strong> {{ $first_name }}</li>
                                <li><strong>Lastname:</strong> {{ $last_name }}</li>
                                <li><strong>Email:</strong> {{ $email }}</li>
                                <li><strong>Password:</strong> {{ $password }}</li>
                                <li><strong>Company Name:</strong> {{ $company }}</li>
                                <li><strong>Address:</strong> {{ $address }}</li>
                                <li><strong>City:</strong> {{ $city }}</li>
                                <li><strong>Country:</strong> {{ $country }}</li>
                                <li><strong>Postcode:</strong> {{ $postcode }}</li>
                                <li><strong>Mobile:</strong> {{ $mobile }}</li>
                            </ul>

                            <p style="font-size: 15px; color: #555;">
                                With your new account, you now have access to our exclusive collection of beauty and
                                cosmetics products.
                                Enjoy a seamless shopping experience, stay updated on the latest trends, and receive
                                personalized offers tailored just for you.
                                We're excited to have you on board and can't wait for you to explore all we have to
                                offer.
                            </p>

                            <p style="font-size: 15px; color: #555;">Warm regards,<br><strong>The Shanana Beauty and Bedroom Products
                                    Team</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td
                            style="background-color: #f8bbd0; text-align: center; padding: 15px; font-size: 13px; color: #555;">
                            &copy; {{ date('Y') }} Shanana Beauty and Bedroom Products. All rights reserved.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>
