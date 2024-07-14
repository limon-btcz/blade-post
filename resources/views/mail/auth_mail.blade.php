<body>
  <div style="background-color:#fafbfe; padding: 1.75rem 0">
    <div 
      style="margin: 0 auto; padding: 1.9375rem 2rem 2.3125rem; border-radius: 0.5rem; max-width: 28rem; 
      text-align: center; color: #212b36; background-color: #ffffff;"
    >
      <div style="margin-bottom: 0.5rem;">
        <a 
          style="display: inline-block; font-size: 1.5rem; line-height: 2rem; text-decoration: none; color: #28c76f;" 
          href={{ config('app.url') }}
        >{{ str_replace('_', ' ', config('app.name')) }}</a>
      </div>
      <h3 style="font-size: 1.25rem; line-height: 1.75rem; font-weight: 700;">{{ $title }}</h3>
      <p style="margin-top: 1rem; font-size: 0.875rem">
        <span style="display: block; font-weight: 700; margin-bottom: 0.9rem">Dear {{ $user_name }},</span> 
        {{ $msg }}
      </p>
      <div style="margin-top: 1.6875rem;">
        <a 
          style="display: inline-block; text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.25rem; color: #ffffff; background-color: #28c76f;"
          href="{{ $link }}" 
        >Click here to verify</a>
      </div>
      <p style="margin-top: 1.5rem; margin-bottom: 0; font-size: 0.875rem; line-height: 1.25rem; color: #555;">
        If you did not request this, please ignore this email.
      </p>
    </div>
  </div>
</body>