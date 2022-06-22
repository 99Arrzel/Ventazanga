<template>
    <div class="flex">
        <div class="w-1/2">
            <DataTable :value="users">
                <Column field="name" header="Nombre"></Column>
                <Column field="last_name_p" header="Ap. Paterno"></Column>
                <Column field="last_name_m" header="Ap. Materno"></Column>
                <Column field="ci" header="CI"></Column>
                <Column field="phone" header="Telefono"></Column>
                <Column field="city" header="Ciudad"></Column>
                <Column field="rol" header="Rol"></Column>
                <Column field="status" header="Estado"></Column>
                <Column field="description" header="Descripcion"></Column>
            </DataTable>
        </div>
    </div>
</template>
<script>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
export default {
    props: ["users"],
    components: {
        DataTable,
        Column,
    },
};
</script>
>
