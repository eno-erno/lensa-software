<template>
  <v-container>
    <div class="card">
      <div class="card-header d-flex" style="background:#f9fbfd">
        <span class="fw-bold">Annual Salary</span>
        <span class="fw-bold ms-auto">
          <router-link to="/annual-salary/add" class="btn btn-sm btn-primary px-3" style="background:#2f3192; border-color:#2f3192">Create</router-link>
        </span>
      </div>

      <div class="card-body">
        <input 
          class="form-control mb-3" 
          placeholder="Search..." 
          v-model="searchQuery" 
          @input="fetchData"
        >

        <!-- Data Table -->
        <v-data-table-server
          v-model:items-per-page="perPage"
          :headers="headers"
          :items="data"
          :loading="loading"
          :items-per-page-options="[5, 10, 25, 50]"
          :page.sync="page"
          :total-items="totalItems"
          item-key="id"
          class="elevation-1"
          @update:page="fetchData"
        >
          <template v-slot:item.adjustment_option="{ item }">
            {{ item.adjustment_option.toUpperCase() }}
          </template>
          <template v-slot:item.adjustment="{ item }">
            {{ formatRupiah(item.adjustment) }}
          </template>
          <template v-slot:item.current_gapok="{ item }">
            {{ formatRupiah(item.current_gapok) }}
          </template>
          <template v-slot:item.new_gapok="{ item }">
            {{ formatRupiah(item.new_gapok) }}
          </template>
          <template v-slot:item.actions="{ item }">
            <router-link :to="`/annual-salary/add/${item.id}?type=edit`" class="badge bg-primary">
                <i class="fa fa-pencil" aria-hidden="true"></i> Edit
            </router-link>

            <!-- Tombol Delete -->
            <span class="badge bg-danger ms-2" style="cursor: pointer;" @click="confirmDelete(item)">
              <i class="fa fa-trash" aria-hidden="true"></i> Delete
            </span>
          </template>
        </v-data-table-server>

        <!-- Pagination -->
        <v-pagination
          v-model:page="page"
          :length="Math.ceil(totalItems / perPage)"
          circle
        ></v-pagination>
      </div>
    </div>

    <!-- Dialog Konfirmasi Hapus -->
    <v-dialog v-model="dialog" persistent max-width="400px">
      <v-card>
        <v-card-title class="text-h5">Confirm Delete</v-card-title>
        <v-card-text>
          Are you sure you want to delete <strong>{{ selectedItem?.name }}</strong>?
        </v-card-text>
        <v-card-actions>
          <v-btn color="grey" text @click="dialog = false">Cancel</v-btn>
          <v-btn color="red" text @click="deleteItem">Delete</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    
  </v-container>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";

export default {
  name: "AnnualSalary",
  setup() {
    const data = ref([]);
    const searchQuery = ref("");
    const page = ref(1);
    const perPage = ref(10);
    const totalItems = ref(0);
    const loading = ref(false);
    const dialog = ref(false);
    const selectedItem = ref(null);

    const headers = [
      { title: "Name", key: "name" },
      { title: "No. Reg", key: "noreg" },
      { title: "Adjustment Option", key: "adjustment_option" },
      { title: "Current Gapok", key: "current_gapok" },
      { title: "New Gapok", key: "new_gapok" },
      { title: "Adjustment", key: "adjustment" },
      { title: "Actions", key: "actions", sortable: false },
    ];

    const fetchData = async () => {
      loading.value = true;
      try {
        const response = await axios.get("/api/list-annual-salary", {
          params: {
            page: page.value,
            per_page: perPage.value,
            search: searchQuery.value,
          },
        });
        data.value = response.data.data;
        totalItems.value = response.data.total;
      } catch (error) {
        console.error("Error fetching data:", error);
      } finally {
        loading.value = false;
      }
    };

    const confirmDelete = (item) => {
      selectedItem.value = item;
      dialog.value = true;
    };

    const deleteItem = async () => {
      try {
        await axios.delete(`/api/list-annual-salary/${selectedItem.value.id}`);
        dialog.value = false;
        fetchData(); 
      } catch (error) {
        console.error("Error deleting item:", error);
      }
    };

    const formatRupiah = (value) => {
      if (!value) return "IDR 0";
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        currencyDisplay: "code",
      }).format(value);
    };

    onMounted(() => {
      fetchData();
    });

    return {
      data,
      searchQuery,
      page,
      perPage,
      totalItems,
      loading,
      headers,
      fetchData,
      formatRupiah,
      dialog,
      selectedItem,
      confirmDelete,
      deleteItem,
    };
  },
};
</script>
