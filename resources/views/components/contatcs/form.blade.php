<!-- Title -->
<div class="col-12 mb-2 mt-5">
    <h4>{!! translating('contacts-page-description') !!}</h4>
</div>

<!-- Form Section -->
<div class="col-lg-6 col-12 p-2 bg-light rounded">
    <!-- Name -->
    <div class="form-group">
        <label>{{ translating('contacts-form-name') }}</label>
        <input type="text" class="form-control input-light" required min="1" max="255" form="sendMessageForm" name="name">
    </div>

    <!-- Phone Number -->
    <div class="form-group">
        <label>{{ translating('contacts-form-phone-number') }}</label>
        <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  type="text" class="form-control input-light" required min="1" max="255" form="sendMessageForm" name="phone">
    </div>

    <!-- Email -->
    <div class="form-group">
        <label>{{ translating('contacts-form-email') }}</label>
        <input type="email" class="form-control input-light" required min="1" max="255" form="sendMessageForm" name="email">
    </div>

    <!-- Message -->
    <div class="form-group">
        <label>{{ translating('contacts-form-message') }}</label>
        <textarea rows="6" class="form-control input-light" required min="1" max="999999" form="sendMessageForm" name="message"></textarea>
    </div>

    <!-- Form -->
    <form id="sendMessageForm" data-id="{{ Auth::user()->id }}" action="{{ route('send-message', ['locale' => app()->getLocale()]) }}" method="post">
        @csrf
        <!-- Submit Button -->
        <button type="submit" id="sendForm" form="sendMessageForm" class="btn float-lg-right btn-success">{{ translating('contacts-form-submit') }}</button>
    </form>

</div>
