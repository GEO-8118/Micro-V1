<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Complete Your Profile | Upskill</title>
<style>
    :root{--navy:#13176b;--gold:#dba617;--white:#ffffff;--surface:#f4f6fb;--text:#101828;--muted:#64748b;--border:#dbe4f0;--radius:16px;}
    *{box-sizing:border-box;}
    body{margin:0;font-family:"Segoe UI",system-ui,sans-serif;background:var(--surface);color:var(--text);}
    .page{max-width:1040px;margin:0 auto;padding:30px 20px;}
    .card{background:var(--white);border:1px solid var(--border);border-radius:var(--radius);box-shadow:0 12px 30px rgba(15,23,42,0.08);overflow:hidden;}
    .hero{background:linear-gradient(135deg,#13176b,#2c4cc6);color:#fff;padding:32px 32px 24px;}
    .hero h1{margin:0;font-size:2rem;letter-spacing:.02em;}
    .hero p{margin:12px 0 0;color:rgba(255,255,255,.85);max-width:640px;line-height:1.6;}
    .form-panel{padding:32px;}
    .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
    .field{display:flex;flex-direction:column;gap:8px;}
    .field.full{grid-column:1/-1;}
    .field label{font-size:.9rem;font-weight:700;color:var(--text);}
    .field input, .field textarea, .field select{border:1px solid var(--border);border-radius:12px;padding:14px 16px;font-size:1rem;color:var(--text);background:#fff;outline:none;transition:border-color .2s ease,box-shadow .2s ease;}
    .field input:focus,.field textarea:focus,.field select:focus{border-color:var(--navy);box-shadow:0 0 0 4px rgba(19,23,107,.08);}
    .field textarea{resize:vertical;min-height:120px;}
    .actions{display:flex;justify-content:flex-end;gap:12px;margin-top:24px;}
    .btn{border:none;border-radius:999px;padding:14px 24px;font-size:1rem;font-weight:700;cursor:pointer;transition:transform .2s ease,background .2s ease;}
    .btn-primary{background:var(--navy);color:#fff;}
    .btn-primary:hover{transform:translateY(-1px);}
    .note{margin-top:18px;font-size:.95rem;color:var(--muted);}
    .alert{background:#fef3c7;color:#92400e;border:1px solid #fcd34d;border-radius:12px;padding:14px 18px;margin-bottom:20px;}
    @media(max-width:900px){.form-grid{grid-template-columns:1fr;}}
</style>
</head>
<body>
<div class="page">
    <div class="card">
        <div class="hero">
            <h1>Finish your profile</h1>
            <p>Just one more step before you can access your dashboard. Please complete your personal details so your profile is ready.</p>
        </div>
        <div class="form-panel">
            @if(session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert">
                    <strong>Please fix the following:</strong>
                    <ul style="margin:12px 0 0 18px;padding:0;list-style:disc;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('profile.complete.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="field full">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
                    </div>
                    <div class="field">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="">Select gender</option>
                            <option value="Male" {{ old('gender', $user->gender ?? '') === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $user->gender ?? '') === 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender', $user->gender ?? '') === 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="date_of_birth">Birthday</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth ?? '') }}" required>
                    </div>
                    <div class="field">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" min="10" max="120" value="{{ old('age', $user->age ?? '') }}" required>
                    </div>
                    <div class="field">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" required>
                    </div>
                    <div class="field">
                        <label for="school_enrolled">School Enrolled</label>
                        <input type="text" id="school_enrolled" name="school_enrolled" value="{{ old('school_enrolled', $user->school_enrolled ?? '') }}" required>
                    </div>
                    <div class="field">
                        <label for="hobby">Hobby</label>
                        <input type="text" id="hobby" name="hobby" value="{{ old('hobby', $user->hobby ?? '') }}">
                    </div>
                    <div class="field">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" value="{{ old('address', $user->address ?? '') }}" required>
                    </div>
                    <div class="field full">
                        <label for="email">Gmail / Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                    </div>
                    <div class="field full">
                        <label for="bio">Bio</label>
                        <textarea id="bio" name="bio" placeholder="Tell us a little about yourself">{{ old('bio', $user->bio ?? '') }}</textarea>
                    </div>
                </div>
                <div class="actions">
                    <button type="submit" class="btn btn-primary">Save and Continue</button>
                </div>
            </form>
            <p class="note">Your details will appear on your profile page once saved.</p>
        </div>
    </div>
</div>
</body>
</html>
