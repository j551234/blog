@extends('./layouts/master')

@section('content')


   
   <section id="contact">
        <div class="contact-container">
            
                <div class="text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <hr class="primary">
                </div>
                
                <div id="message">
					
												
					<form method="post" action="">
					<ul class="dataCols">			
		
						<li>
							<h4><span class="required">*</span><label>問題類別</label></h4>
							<SELECT NAME="cat_code" required="required">
							<OPTION VALUE="">請選擇</OPTION>
														<OPTION VALUE="1" >產品詢問</OPTION>
														<OPTION VALUE="2" >訂貨詢問</OPTION>
														<OPTION VALUE="3" >退貨詢問</OPTION>
														<OPTION VALUE="4" >其它</OPTION>
														</SELECT>	
						</li>
						<li>
							<h4><span class="required">*</span><label>姓名</label></h4>
							<input type="text" size="10" name="name" value="" class="" required="required">
						</li>
						<li>
							<h4><span class="required">*</span><label>聯絡電話</label></h4>
							<input type="text" size="10" name="tel" value="" required="required" class="">
						</li>
						<li>
							<h4><span class="required">*</span><label>Email</label></h4>
							<input type="text" size="30" name="email" value="" required="required" class="width100">						
						</li>						

						<li>
							<h4><span class="required">*</span><label>內容</label></h4>
							<textarea cols="95" rows="5" name="question"  required="required"></textarea>
						</li>
						<li>
							<h4></h4>
							<input type="submit" name="send" class="btn bnt-submit" style="height:35px;" value="送出">
						</li>
					</ul>
					</form>
					
				</div>

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