@component('mail::message')
    # Industrial Tank Quote Request Received

    Dear {{ $quote->contact_name }},

    Thank you for requesting a quote from **{{ config('app.name') }}**.
    We're processing your request for:

    **Company:** {{ $quote->company_name }}
    **Request Date:** {{ $quote->created_at->format('d M Y') }}
    **Expiration Date:** {{ $quote->expiration_date->format('d M Y') }}

    @component('mail::button', ['url' => route('quotes.download', $quote)])
        Download PDF Quote
    @endcomponent

    For any urgent inquiries, contact our sales team:
    📞 {{ config('app.contact_phone') }}
    📧 {{ config('app.contact_email') }}

    Best Regards,
    {{ config('app.name') }} Team
@endcomponent
