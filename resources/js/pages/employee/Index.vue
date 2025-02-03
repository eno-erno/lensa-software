<template>
  <v-container>
    <input 
      class="form-control mb-3" 
      placeholder="Search Employee..." 
      v-model="search" 
      @input="fetchEmployees"
    >
    
    <v-data-table
      :headers="headers"
      :items="employees"
      :loading="loading"
      :items-per-page="perPage"
      class="elevation-1"
      server
      :page="page"
      :items-length="totalItems"
      @update:page="(newPage) => { page.value = newPage; fetchEmployees(); }"
      :footer-props="{
        'items-per-page-options': [5, 10, 25, 50],
        'show-current-page': true,
        'show-first-last-page': true
      }"
    >
      <template v-slot:item.current_gapok="{ item }">
        {{ formatRupiah(item.current_gapok) }}
      </template>
      <template v-slot:item.actions="{ item }">
        <span class="badge bg-primary pointer" @click="selectEmployee(item)">
          <i class="fa fa-exchange" aria-hidden="true"></i> Use Employee
        </span>
      </template>
    </v-data-table>

    <div class="text-center mt-3">
      <v-pagination
        v-model:page="page"
        :length="Math.ceil(totalItems / perPage)"
        circle
        class="d-inline-block"
      ></v-pagination>
    </div>
  </v-container>
</template>

<script>
import axios from "axios";
import { ref, onMounted } from "vue";

export default {
  name: "EmployeeTable",
  emits: ["select-employee"],
  setup(_, { emit }) {
    const employees = ref([]);
    const loading = ref(false);
    const page = ref(1);
    const perPage = ref(10);
    const totalItems = ref(0);
    const search = ref(null);

    const headers = [
      { title: "Employee No", key: "nopeg" },
      { title: "Name", key: "name" },
      { title: "Company", key: "company" },
      { title: "Departemen", key: "department" },
      { title: "Directorate", key: "directorate" },
      { title: "Basic Salary", key: "current_gapok", align: "end" },
      { title: "", key: "actions", sortable: false },
    ];

    const fetchEmployees = async () => {
      loading.value = true;
      try {
        const response = await axios.get("/api/employees", {
          params: {
            per_page: perPage.value,
            page: page.value,
            search: search.value,
          },
        });
        employees.value = response.data.data;
        totalItems.value = response.data.total;
      } catch (error) {
        console.error("Error fetching employees:", error);
      } finally {
        loading.value = false;
      }
    };

    const selectEmployee = (employee) => {
      emit("select-employee", employee);
    };

    onMounted(() => {
      fetchEmployees();
    });

    const formatRupiah = (value) => {
      if (!value) return "IDR 0";
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        currencyDisplay: "code"
      }).format(value);
    };

    return {
      search,
      employees,
      headers,
      loading,
      page,
      perPage,
      totalItems,
      fetchEmployees,
      selectEmployee,
      formatRupiah
    };
  },
};
</script>

<style scope>
  .pointer{cursor:pointer}
</style>
