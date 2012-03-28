(function($) {
	var FILTRO_ARQUIVO = "arquivo";
	var FILTRO_PASTA = "pasta";
	
	/**
	 * INICIALIZA O SISTEMA
	 */
	
	var sistema = function() {
		if (/iPad|iPhone|iPod/i.test(navigator.userAgent)) {
			sistema.portatil = true;
			
			$("div#camada, hr, table#cabecalho, table#lista").addClass("portatil");
		} else {
			sistema.progresso();
		}
		
		sistema.icone(function() {
			window.setTimeout(function() {
				sistema.endereco();
				
				if (window.localStorage) {
					// sistema.parametro();
				}
			}, 5);
		});
	};
	
	sistema.arquivos = [];
	sistema.pastas = [];
	sistema.portatil = false;
	
	/**
	 * CARREGA A LISTA DE PASTAS E ARQUIVOS
	 */
	
	sistema.carregar = function(diretorio) {
		if (sistema.portatil) {
			$("table#lista > tbody").html("<tr><td class=\"icone\"><img src=\".sistema/img/progresso.gif\" alt=\"\" class=\"progresso\" /></td><td class=\"carregando\">(carregando)</td></tr>");
		} else {
			sistema.progresso.abrir();
		}
		
		$.ajax({
			cache: false,
			complete: function(requisicao, mensagem) {
				if (sistema.portatil == false) {
					sistema.progresso.fechar();
				}
			},
			data: {
				diretorio: diretorio
			},
			dataType: "json",
			error: function(requisicao, mensagem) {
				window.location.replace("#/");
			},
			success: function(dados) {
				if (dados.erro) {
					window.location.replace("#/");
				} else {
					var contador = 0;
					
					sistema.arquivos = dados.arquivos;
					sistema.pastas = dados.pastas;
					
					$("table#lista > tbody").html("");
					
					if (sistema.pastas.length > 0) {
						$(sistema.pastas).each(function(indice) {
							if (this.nome && sistema.parametro.filtro(this.nome, FILTRO_PASTA) == false) {
								contador += 1;
								
								$("table#lista > tbody").append("<tr id=\"pasta-" + indice + "-0\"><td class=\"icone\"><img src=\".sistema/img/pasta.png\" alt=\"\" /></td><td class=\"nome\"><a href=\"#/" + dados.diretorio + (dados.diretorio.length > 0 ? "/" : "") + this.nome + "\">" + this.nome + "</a></td></tr>");
							}
						});
					}
					
					if (sistema.arquivos.length > 0) {
						if (contador > 0) {
							$("table#lista > tbody").append("<tr><td class=\"espaco\">&nbsp;</td></tr>");
						}
						
						$(sistema.arquivos).each(function(indice) {
							if (dados.diretorio == "" && this.nome == "index.php") {
								// NÃO HÁ COMO FAZER ESSE TESTE DE FORMA INVERSA, POR ISSO O IF..ELSE
							} else {
								if (this.nome && sistema.parametro.filtro(this.nome, FILTRO_ARQUIVO) == false) {
									var extensao = this.nome.replace(/^.*\.([A-Z0-9]+)$/i, "$1").toLowerCase();
									var icone;
									
									if (sistema.icone.existe(extensao)) {
										icone = "<img src=\".sistema/img/icone/" + extensao + ".png\" alt=\"\" />";
									} else {
										icone = "<img src=\".sistema/img/arquivo.png\" alt=\"\" />";
									}
									
									$("table#lista > tbody").append("<tr id=\"arquivo-" + indice + "-0\"><td class=\"icone\">" + icone + "</td><td class=\"nome" + (this.nome == "index.php" ? " indice" : "") + "\"><a href=\"" + dados.diretorio + (dados.diretorio.length > 0 ? "/" : "") + this.nome + "\">" + this.nome + "</a></td></tr>");
								}
							}
						});
					}
					
					if (sistema.pastas.length == 0 && sistema.arquivos.length == 0) {
						$("table#lista > tbody").html("<tr><td class=\"vazio\">(nenhuma pasta ou arquivo encontrado)</td></tr>");
					} else if (sistema.portatil) {
						sistema.rolar();
					}
				}
			},
			type: "post",
			url: ".sistema/php/varredura.php"
		});
	}
	
	/**
	 * CONTROLE DAS HASHTAGS
	 */
	
	sistema.endereco = function() {
		var endereco = window.location.hash.substring(1);
		
		if (/^\//.test(endereco)) {
			comando = null;
			endereco = unescape(endereco).substring(1);
			
			if (/:[A-Z]+$/i.test()) {
				comando = endereco.replace(/.*:([A-Z]+)$/i, "$1");
				endereco = endereco.replace(/:[A-Z]+$/i, "");
				
				// EXECUTA O COMANDO
			}
			
			if (sistema.endereco.memoria != endereco) {
				var caminho = [];
				var diretorios = endereco.split("/");
				var memoria = [];
				
				sistema.carregar(endereco);
				
				if ($.trim(endereco).length > 0) {
					$("table#cabecalho > tbody > tr > td.titulo").html("<a href=\"#/\">Servidor</a>");
				} else {
					$("table#cabecalho > tbody > tr > td.titulo").html("Servidor");
				}
				
				$(diretorios).each(function(indice) {
					memoria.push(this);
					
					if (indice < diretorios.length - 1) {
						caminho.push("<a href=\"#/" + memoria.join("/") + "\">" + this + "</a>");
					} else {
						caminho.push(this);
					}
				});
				
				$("table#cabecalho > tbody > tr > td.caminho").html("<span class=\"barra\">./</span>" + caminho.join("<span class=\"barra\">/</span>"));
				
				sistema.endereco.memoria = endereco;
			}
		} else {
			window.location.hash = "#/";
		}
		
		window.setTimeout(sistema.endereco, 5);
	};
	
	sistema.endereco.memoria = null;
	
	/**
	 * GERENCIA OS ÍCONES DA LISTA DE ARQUIVOS
	 */
	
	sistema.icone = function(retorno) {
		$.ajax({
			cache: false,
			data: {
				diretorio: ".sistema/img/icone"
			},
			dataType: "json",
			error: function(requisicao, mensagem) {
				window.location.replace("#/");
			},
			success: function(dados) {
				if (dados.erro) {
					window.location.replace("#/");
				} else {
					$(dados.arquivos).each(function() {
						if (this.nome != "pasta.png") {
							sistema.icone.lista.push(this.nome.replace(/\.png$/i, ""));
						}
					});
					
					retorno.call();
				}
			},
			type: "post",
			url: ".sistema/php/varredura.php"
		});
	}
	
	sistema.icone.existe = function(extensao) {
		if ($.inArray(extensao, sistema.icone.lista) == -1) {
			return false;
		} else {
			return true;
		}
	}
	
	sistema.icone.lista = [];
	
	/**
	 * GERENCIA AS OPÇÕES DO SISTEMA
	 */
	
	sistema.parametro = function() {
		// BOTÃO
		
		$("body").append("<img id=\"opcoes\" src=\".sistema/img/opcoes.png\" alt=\"\" title=\"Configurações\" />");
		
		$("img#opcoes").css({
			opacity: 0
		}).animate({
			opacity: 0.4
		}, "fast").hover(function() {
			$(this).animate({
				opacity: 1
			}, "fast");
		}, function() {
			$(this).animate({
				opacity: 0.4
			}, "fast");
		});
		
		// JANELA
		
		
	}
	
	sistema.parametro.filtro = function(nome, tipo) {
		var filtro = false;
		
		switch (tipo) {
			case FILTRO_ARQUIVO:
				$(sistema.parametro.filtro.arquivo).each(function(indice) {
					if (this instanceof RegExp) {
						if (this.test(nome)) {
							filtro = true;
						}
					} else {
						if (this == nome) {
							filtro = true;
						}
					}
				});
				
				break;
			case FILTRO_PASTA:
				$(sistema.parametro.filtro.pasta).each(function(indice) {
					if (this instanceof RegExp) {
						if (this.test(nome)) {
							filtro = true;
						}
					} else {
						if (this == nome) {
							filtro = true;
						}
					}
				});
				
				break;
			default:
				return Boolean(sistema.parametro.filtro(nome, FILTRO_ARQUIVO) | sistema.parametro.filtro(nome, FILTRO_PASTA));
				
				break;
		}
		
		return filtro;
	}
	
	sistema.parametro.filtro.arquivo = [null, /^\..+/];
	sistema.parametro.filtro.pasta = [null, /^\..+/, "RemoteSystemsTempFiles"];
	
	sistema.parametro.abrir = function() {
		
	}
	
	sistema.parametro.fechar = function() {
		
	}
	
	/**
	 * PROGRESSO
	 */
	
	sistema.progresso = function() {
		$("<div />").attr({
			id: "progresso"
		}).css({
			width: $(document).width() + "px",
			height: $(document).height() + "px"
		}).html("&nbsp;").appendTo("body");
	}
	
	sistema.progresso.intervalo = null;
	
	sistema.progresso.abrir = function() {
		sistema.progresso.intervalo = window.setTimeout(function() {
			$("div#progresso").css({
				visibility: "visible"
			});
		}, 5);
	}
	
	sistema.progresso.fechar = function() {
		window.clearTimeout(sistema.progresso.intervalo);
		
		$("div#progresso").css({
			visibility: "hidden"
		});
	}
	
	/**
	 * ROLA A PÁGINA PARA OCULTAR A BARRA DE ENDEREÇO NO IPAD, IPHONE OU IPOD
	 */
	
	sistema.rolar = function() {
		window.setTimeout(function() {
			window.scrollTo(0, 0);
		}, 1);
	}
	
	/**
	 * EXECUTA O SISTEMA QUANDO O DOM ESTIVER PRONTO
	 */
	
	$(sistema);
})(jQuery);