<form id="support-form" action="{{ route('support-message-send-admin', ['locale' => app()->getLocale()]) }}" method="post">
    @csrf
    <div class="form-group">
        <input type="text" class="form-control" form="support-form" required min="2" max="255" name="name" placeholder="Enter Name">
    </div>
    <div class="form-group">
        <input type="email" class="form-control" form="support-form" required min="2" max="255" name="email" placeholder="Enter Email">
    </div>
    <div class="form-group">
        <textarea class="form-control" placeholder="Message" form="support-form" required min="2" name="message" rows="5"></textarea>
    </div>
    <button type="submit" form="support-form" class="btn btn-primary text-uppercase">Submit</button>
</form>