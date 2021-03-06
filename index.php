<?php require('hypertext-preprocessor/header.php'); ?>
			
			<div class="middle">
				
				<div class="introduction">
					<div class="introduction__tip">
						<img src="images/info-busque.png" alt="Identifique e acesse sua cidade para conferir os candidatos" class="introduction__tip__image" />
						<span class="introduction__tip__number">1</span>
						<p class="introduction__tip__title">Busque</p>
						<p class="introduction__tip__description">Identifique e acesse sua cidade para conferir os candidatos.</p>
					</div><div class="introduction__tip">
						<img src="images/info-conecte.png" alt="Entre no Ágora utilizando sua conta no Facebook" class="introduction__tip__image" />
						<span class="introduction__tip__number">2</span>
						<p class="introduction__tip__title">Conecte</p>
						<p class="introduction__tip__description">Entre no Ágora utilizando sua conta no Facebook.</p>
					<div class="fb-like introduction__tip__facebook" data-href="https://www.facebook.com/agora.vc" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
					</div><div class="introduction__tip">
						<img src="images/info-interaja.png" alt="Compartilhe sua intenção de voto com os amigos" class="introduction__tip__image" />
						<span class="introduction__tip__number">3</span>
						<p class="introduction__tip__title">Interaja</p>
						<p class="introduction__tip__description">Compartilhe o seu apoio com os amigos.</p>
					</div>
				</div>
				
			</div>
			
			<div class="main">
				
				<div class="main__nav">
					<ul class="contexttabs">
						<li class="contexttabs__item">
							<a href="javascript:void(0);" title="Ver candidatos" class="contexttabs__link is-active tooltip contexttabs__candidates">
								<img src="images/icon-candidates.png" alt="Ver candidatos" />
							</a>
						</li>
						<li class="contexttabs__item">
							<a href="javascript:void(0);" title="Ver discussão" class="contexttabs__link tooltip contexttabs__discussion">
								<img src="images/icon-discussion.png" alt="Ver discussão" />
								<span class="contexttabs__link__news">+</span>
							</a>
						</li>
					</ul>				
				</div><div class="main__content">
						
					<div class="main__content__wrapper">
					
						<dl class="candidateslist">
							
							<dt class="candidateslist__header mayor">
								<div class="candidateslist__header__wrapper">
									<div class="candidateslist__header__content">
										<div class="breadcrumb">
											<h2>Prefeito</h2>
										</div>
										<div class="currentsupport">
										</div>
										<form class="listfilter">
											<input id="mayor__filter" type="text" name="filterfield" data-post="4" class="listfilter__filterfield" placeholder="Filtrar por candidato ou partido..." autocomplete="off" />
											<img src="images/icon-bloom.png" alt="Filtrar" class="listfilter__icon" />
										</form>
									</div>
								</div>								
							</dt>
							<dd id="mayor__more" class="more__candidateslist__item mayor__more">Carregar mais</dd>
							<dd id="mayor__loader" class="candidateslist__loader mayor__loader"></dd>
							
							<dt class="candidateslist__header alderman">
								<div class="candidateslist__header__wrapper">
									<div class="candidateslist__header__content">
										<div class="breadcrumb">
											<h2>Vereador</h2>
										</div>
										<div class="currentsupport">
										</div>
										<form class="listfilter">
											<input id="alderman__filter" type="text" name="filterfield" data-post="7" class="listfilter__filterfield" placeholder="Filtrar por candidato ou partido..." autocomplete="off" />
											<img src="images/icon-bloom.png" alt="Filtrar" class="listfilter__icon" />
										</form>
									</div>
								</div>
							</dt>
							<dd id="alderman__more" class="more__candidateslist__item">Carregar mais</dd>
							<dd id="alderman__loader" class="candidateslist__loader alderman__loader"></dd>
						</dl>
						
						<?php require('hypertext-preprocessor/discussion.php'); ?>
						
					</div>
					
<?php require('hypertext-preprocessor/footer.php'); ?>