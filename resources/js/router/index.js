import { createRouter, createWebHistory } from 'vue-router';
import EmployeeList from "@/pages/employee/Table.vue";
import FormAnnualSalary from "@/pages/annual/Form.vue";
import AnnualSalary from "@/pages/annual/Index.vue";

const routes = [
    { path: "/", component: EmployeeList },
    { path: "/annual-salary", component: AnnualSalary },
    { path: "/annual-salary/add/:id?", component: FormAnnualSalary }
    
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
