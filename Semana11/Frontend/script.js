// Función para cargar las ventas al cargar la página
window.onload = async () => {
  await cargarVentas();
};

const apiURL='http://localhost/DSS404_2025/Semana11/Webservice/webservice.php';
// Función para cargar las ventas desde el servidor
async function cargarVentas() {
  const response = await fetch(apiURL);
  const data = await response.json();

  const ventasTable = document.getElementById('ventasTable');
  ventasTable.innerHTML = '';

  data.forEach(venta => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
                  <td>${venta.id_venta}</td>
                  <td>${venta.id_usuario}</td>
                  <td>${venta.id_producto}</td>
                  <td>${venta.fecha_venta}</td>
                  <td>
                      <button class="btn btn-warning btn-sm" onclick="editarVenta(${venta.id_venta}, ${venta.id_usuario}, ${venta.id_producto})">Editar</button>
                      <button class="btn btn-danger btn-sm" onclick="eliminarVenta(${venta.id_venta})">Eliminar</button>
                  </td>
              `;
    ventasTable.appendChild(tr);
  });
}

// Función para manejar la edición de una venta
async function editarVenta(idVenta, idUsuario, idProducto) {
  const nuevoIdUsuario = prompt('Ingrese el nuevo ID de Usuario:', idUsuario);
  const nuevoIdProducto = prompt('Ingrese el nuevo ID de Producto:', idProducto);

  if (nuevoIdUsuario !== null && nuevoIdProducto !== null) {
    const response = await fetch(apiURL, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id_venta: idVenta, id_usuario: nuevoIdUsuario, id_producto: nuevoIdProducto })
    });
    const data = await response.json();
    alert(data.message);
    await cargarVentas();
  }
}

// Función para manejar la eliminación de una venta
async function eliminarVenta(idVenta) {
  if (confirm('¿Está seguro de que desea eliminar esta venta?')) {
    const response = await fetch(apiURL, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ id_venta: idVenta })
    });
    const data = await response.json();
    alert(data.message);
    await cargarVentas();
  }
}

// Función para manejar el envío del formulario POST
document.getElementById('postForm').addEventListener('submit', async (event) => {
  event.preventDefault();
  const idUsuario = document.getElementById('idUsuario').value;
  const idProducto = document.getElementById('idProducto').value;
  const response = await fetch(apiURL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ id_usuario: idUsuario, id_producto: idProducto })
  });
  const data = await response.json();
  alert(data.message);
  await cargarVentas();
});

// Función para manejar el envío del formulario GET
document.getElementById('getForm').addEventListener('submit', async (event) => {
  event.preventDefault();
  const idVenta = document.getElementById('idVenta').value;
  const response = await fetch(`http://localhost/DSS404_2025/Semana11/Webservice/webservice.php?id_venta=${idVenta}`);
  const data = await response.json();
  document.getElementById('getResults').innerText = JSON.stringify(data);
});
