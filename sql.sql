select * from config;

UPDATE config SET texto_email_template = '<strong>Nome:</strong> #nome# </br> <strong>E-mail: </strong><span> #email# </span> </br> <strong>Mensagem:</strong> </br><p> #texto# </p>' WHERE id = 1;

select * from blog;

select * from blog ORDER BY imagem DESC LIMIT 2 , 2;

select COUNT(*) from blog;

select * from blog  LIMIT 2 , 3;

select * from blog ORDER BY texto desc LIMIT 4 , 2;

select * from eventos ORDER BY id DESC limit 1;

select * from eventos;


SELECT * FROM eventos where data >= now() ORDER BY horario  LIMIT 3;

select * from categoria;

select COUNT(*) from categoria;

select COUNT(*) from eventos where id_categoria = 4;

select Categoria.categoria, Categoria.id as idcat from categoria INNER JOIN Eventos on Categoria.id = Eventos.id_categoria GROUP BY Categoria.id;

select * from admin;

select * from slider;

select * from eventos where data >= now() ORDER BY data ASC limit 1