ENDPOINTS
Los diferentes endpoints que ofrece la API son los siguientes:

• Obtener TODOS los productos -> GET -> /anuros

• Obtener UN producto -> GET -> /anuro/:ID | (Especificar id en la url)

• Agregar un nuevo anuro -> POST -> /anuro | Se requiere token y es necesario enviar en formato JSON, incluyendo los siguientes campos:  
    {
        "foto": "",
        "especie": "",
        "familia": "",
        "conservacion": "",
        "id_ecosistema_fk": "",
    }
Donde los id's de los ecosistemas son los siguientes:
    {
        Bosque Tropical: 1,
        Desierto = 2,
        Matorral = 3,
        Pantano = 4,
        Bosque Boreal = 5
    }

• Obtener token para agregar un anuro -> GET -> /token | Se debe introducir en Basic Auth con el user y password: admin, admin. Despues se debe copiar el token e introducirlo en Bearer token al momento de hacer un POST.

PARAMETROS
La API cuenta con distintos parametros de busqueda para el filtrado, ordenamiento y paginado, estos se indican con un ? al final de la url.

• orderBy -> sort="": indicando el orden, ascendente o descendente.
          -> field="": indicando el campo por el cual se desea ordenar. 

• where -> where="": Se filtra para mostrar anuros de un ecosistema especificando la id del mismo.

• limit -> limit="": Se especifica la cantidad de anuros que se quieren visualizar como maximo.

• offset -> offset="": Debe ser usado en conjunto con limit, Este da la opcion de seleccionar la pagina que se desea ver con el listado de anuros.

En el caso de omitir algun campo, los parametros de consulta cuentan con un valor por defecto, por lo que las solicitudes GET devolveran los siguientes valores:
    {
    sort -> asc | Trae los resultados ascedentemente.
    field -> id | Ordena los resultados por el campo id.
    where -> anuros.id_ecosistema_fk | Muestra anuros de todos los ecosistemas.
    limit -> 18446744073709551610" | No limita la cantidad de anuros que se visualizan.
    offset -> 0 | No pagina.
    }   

CODIGOS DE ERROR
Es posible que se cometan errores de tipeo u otros en las solicitudes que realiza. La API cuenta con errores especificos que se acompañan de un mensaje que los especifica. Los distintos tipos de errores son:
    {
    200 => "OK",
    201 => "Created",
    400 => "Bad request",
    401 => "Unauthorized",
    403 => "Forbidden",
    404 => "Not found",
    500 => "Internal Server Error"
    }