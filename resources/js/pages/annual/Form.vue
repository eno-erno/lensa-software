<template>
  <v-container>
    <v-card class="p-3 mb-3 shadow">
      <v-card-title>
        <h3 class="mb-0">Form Annual Salary</h3>
      </v-card-title>
    </v-card>
    <v-card class="pa-4 shadow">
      <v-card-text>
        <v-form>
          <div class="row mb-3">
            <div class="col-md-6">
                <div class="row">
                  <label class="col-sm-5 col-form-label">Register No</label>
                  <div class="col-sm-7">
                    <input type="text" v-model="form.noreg" readonly class="form-control">
                  </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                  <label class="col-sm-5 col-form-label">Register Date</label>
                  <div class="col-sm-7">
                    <input type="date" v-model="form.register_date"  class="form-control">
                  </div>
                </div>
            </div>
          </div>
          <div class="row mb-3 border-top pt-2 border rounded">
            <div class="col-12">
              <p>Adjustment Option</p>
            </div>
            <div class="col-md-6 d-flex align-items-center mb-3">
                <div class="">
                  <input
                    class="form-check-input me-2"
                    type="radio"
                    id="percentage"
                    value="percentage"
                    v-model="form.adjustmentType"
                  />
                  <label class="form-check-label" for="percentage">Percentage</label>
                </div>
                <div class="ms-3">
                  <input
                    type="text"
                    class="form-control"
                    v-model="form.percentage"
                    :disabled="form.adjustmentType !== 'percentage'"
                  />
                </div>
                <span class="ms-2"><i class="fa fa-percent"></i></span>
            </div>
            <div class="col-md-6 d-flex align-items-center">
              <div class="">
                <input
                    class="form-check-input me-2"
                    type="radio"
                    id="amount"
                    value="amount"
                    v-model="form.adjustmentType"
                  />
                <label class="form-check-label" for="amount">Amount</label>
              </div>
              <div class="ms-3">
                <input
                  type="text"
                  class="form-control"
                  v-model="form.amount"
                  :disabled="form.adjustmentType !== 'amount'"
                />
              </div>
            </div>
          </div>
        </v-form>
      </v-card-text>
    </v-card>

    <v-card class="pa-4">
      <v-card-text>
        <div class="row mb-3 align-items-center">
          <div class="col-12 col-sm-3">
            <label class="form-check-label" for="">Employee</label>
          </div>
          <div class="col-12 col-sm-9">
            <div class="row align-items-center">
              <div class="col-1">
                <button class="btn btn-sm btn btn-outline-primary" type="button" @click="openModal">
                  <i class="fa fa-search fz-20"></i>
                </button>
              </div>
              <div class="col-4 px-0">
                <input
                  type="text"
                  class="form-control"
                  v-model="form.nopeg"
                  readonly
                  placeholder="No. Peg"
                />
              </div>
              <div class="col-7">
                <input
                  type="text"
                  class="form-control"
                  v-model="form.name"
                  readonly
                  placeholder="Name"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-3 align-items-center">
          <div class="col-12 col-sm-3">
            <label class="form-check-label" for="">Company</label>
          </div>
          <div class="col-12 col-sm-9">
            <input
              type="text"
              class="form-control"
              v-model="form.company"
              readonly
              placeholder="Company"
            />
          </div>
        </div>
        <div class="row mb-3 align-items-center">
          <div class="col-12 col-sm-3">
            <label class="form-check-label" for="">Directorate</label>
          </div>
          <div class="col-12 col-sm-9">
            <input
              type="text"
              class="form-control"
              v-model="form.directorate"
              readonly
              placeholder="Directorate"
            />
          </div>
        </div>
        <div class="row mb-3 align-items-center">
          <div class="col-12 col-sm-3">
            <label class="form-check-label" for="">Division</label>
          </div>
          <div class="col-12 col-sm-9">
            <input
              type="text"
              class="form-control"
              v-model="form.division"
              readonly
              placeholder="Division"
            />
          </div>
        </div>
        <div class="row mb-3 align-items-center">
          <div class="col-12 col-sm-3">
            <label class="form-check-label" for="">Departemen</label>
          </div>
          <div class="col-12 col-sm-9">
            <input
              type="text"
              class="form-control"
              v-model="form.department"
              readonly
              placeholder="Departemen"
            />
          </div>
        </div>
        <div class="row mb-3 align-items-center">
          <div class="col-12 col-sm-3">
            <label class="form-check-label" for="">Section</label>
          </div>
          <div class="col-12 col-sm-9">
            <input
              type="text"
              class="form-control"
              v-model="form.section"
              readonly
              placeholder="Section"
            />
          </div>
        </div>
        <div class="row mb-3 align-items-center">
          <div class="col-12 col-sm-3">
            <label class="form-check-label" for="">Location</label>
          </div>
          <div class="col-12 col-sm-9">
            <input
              type="text"
              class="form-control"
              v-model="form.location"
              readonly
              placeholder="Location"
            />
          </div>
        </div>


        <div class="row rounded border p-3">
          <p class="mb-0 text-muted fw-bold">Basic Salary</p>
          <div class="col-12 mb-3">
            <div class="row align-items-center">
              <div class="col-12 col-sm-3">
                <label class="form-check-label" for="">Prev Basic Salary</label>
              </div>
              <div class="col-12 col-sm-9">
                <input
                  type="text"
                  class="form-control text-end"
                  v-model="formattedCurrentGapok"
                  readonly
                  placeholder="Current Gapok"
                />
              </div>
            </div>
          </div>
          <div class="col-12 mb-3">
            <div class="row align-items-center">
              <div class="col-12 col-sm-3">
                <label class="form-check-label" for="">New Basic Salary</label>
              </div>
              <div class="col-12 col-sm-9">
                <input
                  type="text"
                  class="form-control text-end"
                  v-model="formattedNewGapok"
                  @input="updateNewGapok"
                  placeholder="Current Gapok"
                />
              </div>
            </div>
          </div>
          <div class="col-12 mb-3">
            <div class="row align-items-center">
              <div class="col-12 col-sm-3">
                <label class="form-check-label" for="">Adjusment</label>
              </div>
              <div class="col-12 col-sm-9">
                <input
                  type="text"
                  class="form-control text-end"
                  v-model="formattedAdjustment"
                  placeholder="Current Gapok"
                />
              </div>
            </div>
          </div>
          <div class="col-12 mb-3" v-if="form.adjustmentType === 'percentage'">
            <div class="row align-items-center">
              <div class="col-12 col-sm-3">
                <label class="form-check-label" for="">Percentage Adjusment</label>
              </div>
              <div class="col-12 col-sm-9">
                <input
                  type="text"
                  class="form-control text-end"
                  v-model="formattedPctgAdjustment"
                  readonly
                  placeholder="Current Gapok"
                />
              </div>
            </div>
          </div>
        </div>
      </v-card-text>
      <div class="text-end">
        <router-link to="/annual-salary" class="btn btn-secondary px-3 me-3">Cancel</router-link>
        <v-btn color="primary" @click="submitForm" :disabled="form.new_gapok <= form.current_gapok">
          <i class="fa fa-save me-2"></i> Submit
        </v-btn>
      </div>
    </v-card>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="employeeModalLabel">Use Employee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <EmployeeTable @select-employee="selectEmployee" />
          </div>
        </div>
      </div>
    </div>
  </v-container>
</template>

<script>
import { ref, watchEffect, onMounted, watch, computed } from "vue";
import { Modal } from "bootstrap";
import { useRouter, useRoute } from "vue-router";
import EmployeeTable from "@/pages/employee/Index.vue";
import axios from "axios";

export default {
  components: { EmployeeTable },
  setup() {
    const router = useRouter();
    const route = useRoute();

    const form = ref({
      noreg: "",
      register_date: "",
      nopeg: "",
      name: "",
      company: "",
      department: "",
      division: "",
      section: "",
      location: "",
      current_gapok: 0,
      adjustmentType: "percentage",
      percentage: 0,
      amount: 0,
      new_gapok: 0,
      adjustment: 0,
      pctg_adjustment: 0,
      id: null
    });

    const calculateAdjustment = () => {
      if (form.value.current_gapok > 0) {
        form.value.adjustment = form.value.new_gapok - form.value.current_gapok;
        if (form.value.adjustmentType === "percentage") {
          form.value.pctg_adjustment = parseFloat(
            ((form.value.adjustment / form.value.current_gapok) * 100).toFixed(4)
          );
        }
      }
    };
    
    onMounted(() => {
      calculateAdjustment();
      
      if (route.params.id && route.query.type == 'new') {
        getDataEmployee(route.params.id)
      } else if (route.params.id && route.query.type == 'edit') {
        getDataAnnual(route.params.id)
      } else {
        getCodeAnnual();
      }
    });

    watch(() => form.value.new_gapok, () => {
      calculateAdjustment();
    });

    watchEffect(() => {
      calculateAdjustment();
    });


    // method
    const getDataEmployee = async (id) => {
      await axios.get(`/api/employees/${id}`)
          .then(response => {
            response.data.data.id = null
            form.value = {
              ...form.value,
              ...response.data.data,
            };
          })
          .catch(error => {
            console.error('Error fetching data:', error);
          });
    }

    const getDataAnnual = async (id) => {
      await axios.get(`/api/detail-annual-salary/${id}`)
          .then(response => {
            form.value = {
              ...form.value,
              ...response.data.data,
            };
          })
          .catch(error => {
            console.error('Error fetching data:', error);
          });
    }

    const getCodeAnnual = async (id) => {
      await axios.get(`/api/annual_salary-getnoreg`)
          .then(response => {
            form.value.noreg = response.data.code
            form.value.register_date = response.data.date
          })
          .catch(error => {
            console.error('Error fetching data:', error);
          });
    }

    

    const openModal = () => {
      const modal = new Modal(document.getElementById("employeeModal"));
      modal.show();
    };

    const selectEmployee = (employee) => {
      if (employee && employee.nopeg && employee.name && employee.company) {
        employee.id = null
        form.value = {
          ...form.value,
          ...employee,
        };
        calculateAdjustment();

        const modal = Modal.getInstance(document.getElementById("employeeModal"));
        if (modal) modal.hide();
      }
    };

    const formatCurrency = (value) => new Intl.NumberFormat("id-ID", {
      style: "decimal",
      minimumFractionDigits: 0,
    }).format(value || 0);

    const formattedCurrentGapok = computed(() => formatCurrency(form.value.current_gapok));
    const formattedNewGapok = computed(() => formatCurrency(form.value.new_gapok));
    const formattedAdjustment = computed(() => formatCurrency(form.value.adjustment));
    const formattedAmount = computed(() => formatCurrency(form.value.amount));
    const formattedPctgAdjustment = computed(() => `${form.value.pctg_adjustment.toFixed(2)}`);

    const updateNewGapok = (event) => {
      const value = parseInt(event.target.value.replace(/[^\d]/g, ""), 10) || 0;
      form.value.new_gapok = value;
      calculateAdjustment();
    };

    const submitForm = async () => {
      try {
        const response = await axios.post("/api/annual_salary", form.value);
        router.push("/annual-salary");
      } catch (error) {
        console.error("Error:", error);
        alert("Terjadi kesalahan saat menyimpan data.");
      }
    };

    return { 
      form, 
      openModal, 
      selectEmployee, 
      submitForm, 
      updateNewGapok, 
      formattedCurrentGapok, 
      formattedNewGapok, 
      formattedAdjustment, 
      formattedAmount, 
      formattedPctgAdjustment 
    };
  },
};

</script>

<style scoped>
 .fz-20{font-size:20px}
</style>
