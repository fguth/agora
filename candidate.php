<?php require("hypertext-preprocessor/header.php"); ?>
			
			<div class="main">
				
				<div class="main__nav">
					<ul class="contexttabs">
						<li class="contexttabs__item">
							<a href="javascript:void(0)" title="Ver candidatos" class="contexttabs__link is-active tooltip">
								<img src="images/icon-candidates.png" alt="Ver candidatos" />
							</a>
						</li>
						<li class="contexttabs__item">
							<a href="javascript:void(0)" title="Ver discussão" class="contexttabs__link tooltip">
								<img src="images/icon-discussion.png" alt="Ver discussão" />
								<span class="contexttabs__link__news">+</span>
							</a>
						</li>
					</ul>				
				</div><div class="main__content">
					
					<div class="main__content__wrapper">

						<div class="candidateinfo">
							
							<div class="candidateinfo__header">
								<div class="candidateinfo__header__wrapper">
									<div class="candidateinfo__header__content">
										<a href="javascript:history.back()" class="candidateinfo__backbutton">Voltar</a>
										<div class="breadcrumb">
											<h2>Prefeito para São Paulo</h2>
										</div>
									</div>
								</div>
							</div>
							
							<div class="candidateinfo__main">
								
								<div class="candidateslist__item">
									<a href="http://development.agora.vc/candidate.php" class="candidatecard">
										<img src="images/candidates/<?php echo ($header->candidate->id_tse);?>.jpg" alt="<?php echo ($header->candidate->name); ?>" class="candidatecard__photo" />
										<p class="candidatecard__name">
											<?php echo ($header->candidate->name); ?>
										</p>
									</a>
									<div class="support" id="123123123">
										<div class="support__counter">
											<span class="support__counter__number">88</span>
										</div>
										<a href="javascript:void(0);" class="support__button">
											<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
										</a>
										<a href="javascript:void(0);" class="unsupport__button is-hidden">
											<span class="unsupport__button__text">Desfazer</span>
										</a>
									</div>
								</div>
								
								<div class="candidateinfo__main__content">
									<h2 class="candidateinfo__candidatename">
										<?php echo ($header->candidate->name); ?>
									</h2>
									<table class="candidateinfo__details">
										<tr>
											<td class="candidateinfo__details__title">Número:</td>
											<td>47840</td>
										</tr>
										<tr>
											<td class="candidateinfo__details__title">Data de nascimento:</td>
											<td>22/08/1920</td>
										</tr>
 										<tr>
											<td class="candidateinfo__details__title">Partido:</td>
											<td>PCdoB - Partido Comunista do Brasil</td>
										</tr>
									<table>
									<a href="#" target="_blank" class="candidateinfo__externallink">Ficha do candidato no STF</a>
								</div>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
				
			</div>
			
<?php require('hypertext-preprocessor/footer.php'); ?>
			
