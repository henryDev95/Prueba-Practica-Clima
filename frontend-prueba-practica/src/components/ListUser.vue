<script setup>
import { ref, onMounted, computed  } from "vue";
import { Modal } from "bootstrap";

const apiUrlBase = import.meta.env.VITE_API_URL_BASE;

const personaSeleccionada = ref(null);
const personas = ref([]);
const loading = ref(true);
const error = ref(null);
const icono = ref(null)

let modalInstance = null;


const obtenerInformacionUsuarios= async () => {
  try {
    const response = await fetch(
      apiUrlBase
    );

    if (!response.ok) {
      throw new Error("Error al obtener los datos");
    }
    
    personas.value = await response.json();

  } catch (error) {
    error.value = err.message;
    personas.value = null;
  }finally {
    loading.value = false;
  }
};

const verDetalles = async (persona) => {
  personaSeleccionada.value = persona;
  icono.value = `https://openweathermap.org/img/wn/${persona.location.weather.icon}@2x.png`
  if (modalInstance) {
    modalInstance.show();
  }
};

// Inicializar el modal al montar el componente
onMounted(() => {
  obtenerInformacionUsuarios();
  const modalElement = document.getElementById("detallesModal");
  if (modalElement) {
    modalInstance = new Modal(modalElement);
  }
});


const currentPage = ref(1);
const itemsPerPage = 9; // Número de usuarios a mostrar por página

// Calcular el número total de páginas
const totalPages = computed(() => {
  return Math.ceil(personas.value.length / itemsPerPage);
});

// Calcular los elementos a mostrar en la página actual
const paginatedDataPersona = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  return personas.value.slice(start, end);
});

// Cambiar la página
const changePage = (page) => {
  if (page < 1 || page > totalPages.value) return; // Evitar páginas fuera de rango
  currentPage.value = page;
};

</script>

<template>
  <div class="container mt-4">
    <h2 class="text-center">Lista de Usuarios</h2>
  
    <br><br>
    <div v-if="loading"  class="text-center" >Cargando...</div>
    <div v-if="error">Error: {{ error }}</div>

    <table v-if="!loading && !error" class="table table-striped table-bordered" ref="dataTable">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>CIUDAD</th>
          <th>ESTADO</th>
          <th>PAIS</th>
          <th>LATITUD</th>
          <th>LONGITUD</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="persona in paginatedDataPersona" :key="persona.id">
          <td>{{ persona.id }}</td>
          <td>{{ persona.name }}</td>
          <td>{{ persona.location.city }}</td>
          <td>{{ persona.location.state }}</td>
          <td>{{ persona.location.country }}</td>
          <td>{{ persona.location.latitude }}</td>
          <td>{{ persona.location.longitude }}</td>
          <td>
            <button class="btn btn-primary btn-sm" @click="verDetalles(persona)">
              <i class="bi bi-eye"></i> Ver Información
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Paginación -->
    <nav v-if="!loading && !error" aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
          <button class="page-link" @click="changePage(currentPage - 1)">Anterior</button>
        </li>
        <li
          v-for="page in totalPages"
          :key="page"
          class="page-item"
          :class="{ active: currentPage === page }"
        >
          <button class="page-link" @click="changePage(page)">{{ page }}</button>
        </li>
        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
          <button class="page-link" @click="changePage(currentPage + 1)">Siguiente</button>
        </li>
      </ul>
    </nav>
  

    <!-- Modal de Detalles con Clima -->
    <div class="modal fade" id="detallesModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">Detalles de la Persona</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p><strong>ID:</strong> {{ personaSeleccionada?.id }}</p>
            <p><strong>Nombre:</strong> {{ personaSeleccionada?.name }}</p>
            <p><strong>Correo Electronico:</strong> {{ personaSeleccionada?.email }}</p>
            <p><strong>Direccion:</strong> {{ personaSeleccionada?.location.address }}</p>
            <p><strong>Ciudad:</strong> {{ personaSeleccionada?.location.city }}</p>
            <hr />
            <h5 class="mt-3">Datos del Clima</h5>
             <!-- Imagen del clima -->
             <img v-if="icono" :src="icono" alt="Icono del Clima" class="mb-2" />

            <p><strong>Temperatura:</strong> {{ personaSeleccionada?.location.weather.temperature }}°C</p>
            <p><strong>Descripción:</strong> {{ personaSeleccionada?.location.weather.description }}</p>
            <p><strong>Humedad:</strong> {{ personaSeleccionada?.location.weather.humidity }}%</p>
            <p><strong>Presion:</strong> {{ personaSeleccionada?.location.weather.pressure }} hPa</p>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


