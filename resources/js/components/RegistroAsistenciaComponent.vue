<template>
    <v-container>
        <v-row>
            <v-col cols="12" md="4">
                <v-date-picker
                    locale="es-pe"
                    full-width
                    v-model="fecha"
                ></v-date-picker>
            </v-col>
            <v-col cols="12" md="8">
                <v-card>
                    <v-card-title>
                        <small
                            >Asistendia del dia
                            <strong> {{ select_fecha }} </strong>
                        </small>

                        <v-spacer></v-spacer>
                    </v-card-title>

                    <v-data-table
                        :loading="loading_table"
                        :headers="headers"
                        :items="items"
                        :items-per-page="20"
                        class="elevation-1"
                    >
                        <template v-slot:item.estado="{ item }">
                            <v-chip small :color="getColor(item.estado)" dark>
                                {{ item.estado }}
                            </v-chip>
                        </template>
                    </v-data-table>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data: () => ({
        fecha: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
            .toISOString()
            .substring(0, 10),
        headers: [
            { text: "Nombre", value: "trabajador.nombre" },
            { text: "Horario", value: "trabajador.horario" },
            { text: "Entrada", value: "entrada" },
            { text: "Salida", value: "salida" },
            { text: "Estado", value: "estado" },
        ],

        items: [],
        loading_table: false,
        select_fecha: '',
    }),

    created() {
        this.inicializar();
    },
    watch: {
        fecha(nuevoValor, valorAnterior) {
            this.getListaAsistencia();
        },
    },
    methods: {
        inicializar() {
            this.getListaAsistencia();
        },
        async getListaAsistencia() {
            this.loading_table = true;
            let res = await axios.get("/asistencia/lista/" + this.fecha);
            this.items = res.data.datos;
            this.select_fecha = res.data.select_fecha;
            this.loading_table = false;

        },

        getColor(estado) {
            if (estado == "Falta") return "red";
            else if (estado == "Tarde") return "orange";
            else return "green";
        },

        CambiarFecha(date) {
            console.log("fecha cambiada");

            this.getListaAsistencia();
        },
    },
};
</script>
