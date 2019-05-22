Nette
---
Por defecto Nette utiliza PHP 5.6 pero funciona mejor con PHP +7.1 para disponer de varias funciones, consultar composer.json para ver la version de PHP o cambiarla.


Mesas
---
Solo contiene el número de mesa y algunos datos más sobre la mesa, como el estado de la misma, el número de comensales, etc

MesaPedidos
---
Relacional para listar todos los pedidos que ha tenido una mesa


Pedidos
---
Aquí se recoge cada orden que se tiene que preparar para una mesa. Básicamente sería cada línea que hay en el ticket final.
En esta estructura, un pedido se considera un item, es decir,
un plato/combinación como por ejemplo, esto serían platos ya configurados:
- Hamburguesa de pollo, "sin pepinillos + ketchup" (entre "" son variaciones extra)
- Ron + cocacola
- Agua mineral

Como cada producto tiene su unidad, los platos (combinaciones porque son tanto comida como bebida precofiguradas)

Si se tiene que poder pedir algo que no existe, habría que mirar de implementar
una tabla que fuese capaz de guardar platos personalizados fuera de la tabla platos para no enguarrarla.

PedidosVariaciones
---
En esta tabla se indican las variaciones del pedido, es decir los productos + o - que
tiene que llevar dicho pedido compuesto de un plato/combinación y sus variaciones
Por ejemplo
- Pepinillos = 0 (sin pepinillos)
- Huevo = 2 (+ 2 unidades de huevo)

Platos
---
Son combinaciones de productos predeterminadas que representan un producto que se puede pedir en la carta

Pueden ser bebidas, cócteles, platos, postres, etc (el nombre no es muy acertado)
Ej:
- café solo  (consta de 10gr café)
- café con leche (consta de 10gr café + 10ml leche)
- Hamburguesa con patatas (consta de 1ud hamburguesa de pollo 1ud pan de ham, 250gr patatas, 10gr lechuga, 10 gr pepinillos)

La categoría aquí indica qué tipo de plato/combinación es, por ejemplo:
- Bebidas
- Cócteles
- Primeros
- Segundos
- Postres
- Varios
- etc

Con las categorías luego podrías crear secciones en la interfaz para agrupar los platos

PlatosProductos
---
En esta tabla relacional se explica la cantidad de productos que hay que ponerle a este plato.
Esto te sirve por ejemplo para calcular el precio de coste sabiendo lo que vale 1 ud del producto.
También para poder crear las combinaciones que van dentro de un plato.

Productos
---
Aquí van los productos disponibles para añadir a platos o vender por separado siempre que se haga
en un pedido.

La idea es que esta tabla también sirve de stock ya que solo hay un almacén. Simplemente hay
que indicar el tipo de unidad en la que se mide este producto y la cantidad que queda para
ir restándola con lo que necesite cada plato.

Por ej
- huevo por unidad
- Wishkey si mides la dosis por ml, que es lo suyo
- Hamburguesas por unidad
- Patatas por gr

Si se hace bien se supone que todas estas cosas se pesan y se llevan bien medidas (como en mcdonals), no se
supone que se echen cantidades random.
