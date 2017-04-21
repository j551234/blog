@extends('./layouts/master')

@section('content')


   
   <section id="contact">
        <div class="contact-container">
            
                <div class="text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <hr class="primary">
                </div>
                
            <article>

			<div class="content">

				<p>若您有什麼問題，請填寫下列表格並送出，我們會盡快聯絡您，謝謝! </p>

				<form id="contact-form" name="contact-form" enctype="multipart/form-data" method="post" action="mail">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				

					<fieldset>

						<label class="contact-type" for="Field5">What kind of problem?</label>
						<select class="contact-type" id="Field5" name="problem" >
							<option value="Function Problem" selected>功能問題</option>
							<option value="Product Problem">產品問題</option>
							<option value="Other">其他</option>
						</select>

						

						<label class="contact-name" for="Field2">Name</label>
						<input class="contact-name" id="Field2" name="contact_name" type="text" maxlength="255" />

						<label class="contact-email" for="Field7">Email Address</label>
						<input class="contact-email" id="Field7" name="contact_mail" type="text" spellcheck="false" maxlength="255" tabindex="4" required data-error-msg="Please enter a valid email address." />

						<label class="contact-phone" for="Field4">Phone Number</label>
						<input class="contact-phone" id="Field4" name="contact_number" type="text" maxlength="255"/>
						
						<label class="contact-message" for="Field1">Message</label>
						<textarea class="contact-message" id="Field1" name="contact_message" spellcheck="true" required data-error-msg="Please enter a message."></textarea>
                      
                           <script type="text/javascript">
							function display_alert()
							  {
							  alert("感謝你的回報")
							  }
							</script>
						


					    <input class="submit-btn" name="saveForm" type="submit" value="Send Message"  onclick="display_alert()">

						<div class="hide">
							<label for="comment">Do Not Fill This Out</label>
							<textarea name="comment" id="comment" rows="1" cols="1"></textarea>
							<input type="hidden" id="idstamp" name="idstamp" value="yFYl0eV7r0QSSz4/gkRlqrQqKQq490aGeCqHFl7P6HY=" />
						</div>

					</fieldset>

				</form>

			</div><!-- end .content -->

		    </article>

	    <div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p>123-456-6789</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a href="mailto:your-email@your-domain.com">feedback@startbootstrap.com</a></p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-facebook-official fa-3x sr-contact"></i>
                    <p>123-456-6789</p>
                </div>
            </div>
        </div>
    </section>


@endsection