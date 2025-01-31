<x-frontend.header>
</x-frontend.header>
<section id="contact" data-stellar-background-ratio="0.5">
    <div class="container">

        <div class="row">
            <div class="col-md-12 col-sm-12">

                <div class="col-md-12 col-sm-12 text-center">
                    <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                        <h2>Book a table</h2>
                    </div>
                </div>
                @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <!-- FORM -->
                <form action="{{ route('books.store') }}" method="GET" class="wow fadeInUp" id="contact-form"
                    role="form" data-wow-delay="0.8s">
                    @csrf

                    <div class="col-md-12 col-sm-6">
                        <input required type="text" class="form-control" id="cf-name" name="name"
                            value="{{ old('name') }}" placeholder="Full name">
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <input required type="email" class="form-control" id="cf-email" name="email"
                            value="{{ old('email') }}" placeholder="Email address">
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <input required type="number" class="form-control @error('number') is-invalid @enderror"
                            id="cf-phone" name="phone" value="{{ old('phone') }}" placeholder="Phone">
                        @error('phone')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="">
                            <input required type="date" class="form-control" id="cf-date" name="date"
                                value="{{ old('date') }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <select class="form-control" required name='time' value="{{ old('time') }}">
                            <option value="">Select time</option>
                            <option value="10-00">10:00</option>
                            <option value="11-00">11:00</option>
                            <option value="12-00">12:00</option>
                            <option value="13-00">13:00</option>
                            <option value="14-00">14:00</option>
                            <option value="15-00">15:00</option>
                            <option value="16-00">16:00</option>
                            <option value="16-30">16:30</option>
                            <option value="17-00">17:00</option>
                            <option value="17-30">17:30</option>
                            <option value="18-00">18:00</option>
                            <option value="18-30">18:30</option>
                            <option value="19-00">19:00</option>
                            <option value="19-30">19:30</option>
                            <option value="20-00">20:00</option>
                            <option value="20-30">20:30</option>
                            <option value="21-00">21:00</option>
                            <option value="21-30">21:30</option>
                            <option value="22-00">22:00</option>
                            <option value="22-30">22:30</option>
                            <option value="23-00">23:00</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <select required class="form-control" name='guest' value="{{ old('time') }}">
                            <option value="">How many persons?</option>
                            <option value="1-Person">1 Person</option>
                            <option value="2-Persons">2 Persons</option>
                            <option value="3-Persons">3 Persons</option>
                            <option value="4-Persons">4 Persons</option>
                            <option value="5-Persons">5 Persons</option>
                            <option value="6-Persons">6 Persons</option>
                            <option value="7-Persons">7 Persons</option>
                            <option value="8-Persons">8 Persons</option>
                            <option value="9-Persons">9 Persons</option>
                            <option value="10-Persons">10 Persons</option>
                        </select>
                    </div>

                    <div class="col-md-6 col-sm-6">

                        <div class="">
                            <textarea required class="form-control" rows="4" id="cf-note" name="note" value="{{ old('note') }}"
                                placeholder="Comments"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">

                        <button type="submit" class="form-control" id="cf-submit" name="submit">Book</button>
                        <a href="/" class="btn btn-danger">Back</a>
                    </div>
            </div>
            </form>
        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var errors = $('.is-invalid')
            if (errors.length) {
                $(document).scrollTop(errors.offset().top)
            }
        });
    </script>
</section>
