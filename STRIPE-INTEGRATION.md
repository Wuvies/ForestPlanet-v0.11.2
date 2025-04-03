# ForestPlanet Stripe Integration

This document provides instructions for setting up the Stripe payment gateway integration for ForestPlanet's donation system.

## Installation

1. Install the Stripe PHP SDK using Composer:
   ```
   composer require stripe/stripe-php
   ```

2. Ensure all the necessary files are present:
   - `inc/stripe-settings.php`
   - `inc/stripe-api.php` 
   - `inc/donations-admin.php`
   - `assets/js/stripe-checkout.js`

## Configuration

1. Log in to the WordPress admin panel.
2. Navigate to the "Stripe Settings" page in the admin menu.
3. Enter your Stripe API keys:
   - For testing, use your Test API keys from the Stripe Dashboard.
   - For production, use your Live API keys from the Stripe Dashboard.

4. Select the appropriate mode (Test or Live) based on your environment.
5. Choose the currency for donations.
6. Set up a webhook endpoint in your Stripe Dashboard pointing to:
   ```
   https://your-site.com/wp-json/forestplanet/v1/stripe-webhook
   ```
7. Enter the webhook signing secret in the settings page.
8. Save your settings.

## Webhook Events

The integration listens for the following webhook events:
- `payment_intent.succeeded` - Triggered when a payment is successful
- `payment_intent.payment_failed` - Triggered when a payment fails

## Testing

1. Set the Stripe mode to "Test Mode" in the settings.
2. Use Stripe's test card numbers for testing:
   - Success: `4242 4242 4242 4242` (any future expiration date, any 3-digit CVC)
   - Decline: `4000 0000 0000 0002` (any future expiration date, any 3-digit CVC)

## Viewing Donations

1. Navigate to the "Donations" page under "Stripe Settings" in the admin menu.
2. View all donation records, including completed and failed payments.
3. Click on a donation to view detailed information.

## Troubleshooting

If you experience issues with the Stripe integration:

1. Check that your API keys are entered correctly.
2. Verify that your webhook is properly configured in your Stripe Dashboard.
3. Check the WordPress error log for any Stripe-related errors.
4. Ensure the Stripe PHP SDK is properly installed via Composer.

## Security

- The Stripe integration uses Stripe Elements for secure card collection to maintain PCI compliance.
- API keys are stored securely in the WordPress database.
- All sensitive data is transmitted securely via HTTPS.

For more information about Stripe, visit [stripe.com](https://stripe.com). 