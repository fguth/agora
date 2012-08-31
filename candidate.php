<?php require("hypertext-preprocessor/header.php"); ?>
			
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

						<div class="candidateinfo">
							
							<div class="candidateinfo__header">
								<div class="candidateinfo__header__wrapper">
									<div class="candidateinfo__header__content">
										<a href="http://<?php echo (HOST); ?>/<?php echo ($header->state_sa); ?>/<?php echo ($header->city_url); ?>" class="candidateinfo__backbutton">Voltar</a>
										<div class="breadcrumb">
											<h2>
												<?php echo ($header->candidate->post_name); ?> para <?php echo ($header->candidate->city_name); ?>
											</h2>
										</div>
									</div>
								</div>
							</div>
							
							<div class="candidateinfo__main">
								
								<div class="candidateslist__item">
									<a href="http://development.agora.vc/candidate.php" class="candidatecard">
										<img
											src="images/candidates/<?php echo ($header->candidate->id_tse); ?>.jpg"
											alt="<?php echo ($header->candidate->name); ?>"
											class="candidatecard__photo"
										/>
										<p class="candidatecard__name">
											<?php echo ($header->candidate->name); ?>
										</p>
									</a>
									<div class="support" id="123123123">
										<div class="support__counter">
											<span class="support__counter__number">
												<?php echo ($header->candidate->supports); ?>
											</span>
										</div>
										<?php if ($header->hasSupport($header->candidate->id)) { ?>
											<a id="<?php echo ($header->candidate->id); ?>" data-post="<?php echo ($header->candidate->post_id); ?>" href="<?php echo ($header->candidate->id); ?>" class="unsupport__button">
												<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Desfazer</span>
											</a>
										<?php } else { ?>
											<a id="<?php echo ($header->candidate->id); ?>" data-post="<?php echo ($header->candidate->post_id); ?>" href="<?php echo ($header->candidate->id); ?>" class="support__button">
												<img src="images/icon-support.png" alt="Apoiar candidato" class="support__button__icon" /><span class="support__button__text">Apoiar</span>
											</a>
										<?php } ?>
									</div>
								</div>


								
								<div class="candidateinfo__main__content">
									<h2 class="candidateinfo__candidatename">	
										<?php echo ($header->candidate->name); ?>
									</h2>
									<table class="candidateinfo__details">
										<tr>
											<td class="candidateinfo__details__title">Número:</td>
											<td>
												<?php echo ($header->candidate->number); ?>
											</td>
										</tr>
										<tr>
											<td class="candidateinfo__details__title">Data de nascimento:</td>
											<td>
												<?php echo ($header->candidate->birth_si); ?>
											</td>
										</tr>
 										<tr>
											<td class="candidateinfo__details__title">Partido:</td>
											<td>
												<?php echo ($header->candidate->party_acronym); ?> - <?php echo ($header->candidate->party_name); ?>
											</td>
										</tr>
									</table>
									<a
										href="http://divulgacand2010.tse.jus.br/divulgacand2010/jsp/abrirTelaDetalheCandidato.action?sqCand=<?php echo ($header->candidate->id_tse); ?>&sgUe=BR"
										target="_blank"
										class="candidateinfo__externallink">
											Ficha do candidato no TSE
									</a>
								</div>
								
							</div>
							
						</div>

						<div class="discussion">	
							<div class="discussion__header">
								<div class="breadcrumb">
									<h2>Discussão</h2>
								</div>
								<?php if ($header->candidate->post_id == 4) { ?>
								<div class="currentsupport support_mayor">
									<img src="images/candidates/<?php echo ($header->candidate->id_tse); ?>.jpg" alt="<?php echo ($header->candidate->name); ?>" class="currentsupport__candidatephoto" />
									<p class="currentsupport__label">Prefeito(a)<a href="<?php echo ($header->address); ?>" class="currentsupport__candidatename"><?php echo ($header->candidate->name); ?></a></p>
								</div>
								<?php } else { ?>
								<div class="currentsupport support_alderman">
									<img src="images/candidates/<?php echo ($header->candidate->id_tse); ?>.jpg" alt="<?php echo ($header->candidate->name); ?>" class="currentsupport__candidatephoto" />
									<p class="currentsupport__label">Vereador(a)<a href="<?php echo ($header->address); ?>" class="currentsupport__candidatename"><?php echo ($header->candidate->name); ?></a></p>
								</div>
								<?php } ?>
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
			
