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
					</div><div class="introduction__tip">
						<img src="images/info-interaja.png" alt="Compartilhe sua intenção de voto com os amigos" class="introduction__tip__image" />
						<span class="introduction__tip__number">3</span>
						<p class="introduction__tip__title">Interaja</p>
						<p class="introduction__tip__description">Compartilhe sua intenção de voto com os amigos.</p>
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
											<img src="#" alt="Candidate photo" class="currentsupport__candidatephoto" />
											<p class="currentsupport__label">Você apoia <a href="#" class="currentsupport__candidatename">Candidate name</a></p>
										</div>
										<form class="listfilter">
											<input type="text" name="filterfield" class="listfilter__filterfield" placeholder="Filtrar por candidato ou partido..." />
											<img src="images/icon-bloom.png" alt="Filtrar" class="listfilter__icon" />
										</form>
									</div>
								</div>
																
							</dt>
							<dd class="candidateslist__loader mayor__loader"></dd>
							
							<dt class="candidateslist__header alderman">
								<div class="candidateslist__header__wrapper">
									<div class="candidateslist__header__content">
										<div class="breadcrumb">
											<h2>Vereador</h2>
										</div>
										<div class="currentsupport">
											<img src="#" alt="Candidate photo" class="currentsupport__candidatephoto" />
											<p class="currentsupport__label">Você apoia <a href="#" class="currentsupport__candidatename">Candidate name</a></p>
										</div>
										<form class="listfilter">
											<input type="text" name="filterfield" value="Filtrar" class="listfilter__filterfield" />
											<img src="images/icon-bloom.png" alt="Filtrar" class="listfilter__icon" />
										</form>
									</div>
								</div>
							</dt>
							<dd class="candidateslist__loader alderman__loader"></dd>									
						</dl>
						
						<div class="discussion">
							
							<div class="discussion__header">
								<div class="breadcrumb">
									<h2>Discussão</h2>
								</div>
								<div class="currentsupport">
									<img src="#" alt="Candidate photo" class="currentsupport__candidatephoto" />
									<p class="currentsupport__label">Você apoia <a href="#" class="currentsupport__candidatename">Candidate name</a></p>
								</div>
								<div class="currentsupport">
									<img src="#" alt="Candidate photo" class="currentsupport__candidatephoto" />
									<p class="currentsupport__label">Você apoia <a href="#" class="currentsupport__candidatename">Candidate name</a></p>
								</div>
							</div>
							
							<div class="row-division">
								<hr />
							</div>
							
							<div class="fbcomments">
								<fb:comments href="<?php echo($header->address); ?>" num_posts="5" width="737"></fb:comments>
							</div>
						
						</div>
						
					</div>
					
<?php require('hypertext-preprocessor/footer.php'); ?>