<template>
    <v-container>
        <v-row>
            <v-col cols="12" md="4">
                <v-date-picker
                    locale="es-pe"
                    full-width
                    type="month"
                    v-model="fecha"
                ></v-date-picker>
            </v-col>
            <v-col cols="12" md="8">
                <v-card>
                    <v-card-title>
                        <small
                            >Horas de trabajo del mes de 
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
                        <template v-slot:item.horas="{ item }">
                            {{ item.horas | horas }}
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
            { text: "Nombre", value: "nombre" },
            { text: "Horas trabajadas", value: "horas" },
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
            this.getHorasTrabajo();
        },
    },
    methods: {
        async inicializar() {
            await this.getHorasTrabajo();
        },
        async getHorasTrabajo() {
            this.loading_table = true;
            let res = await axios.get("/asistencia/horas/" + this.fecha);
            this.items = res.data.datos;
            this.select_fecha = res.data.select_fecha;
            this.loading_table = false;
        },
    },

    filters: {
        horas: function (value) {
            let hour = Math.floor(value / 3600);
            hour = hour < 10 ? "0" + hour : hour;
            let minute = Math.floor((value / 60) % 60);
            minute = minute < 10 ? "0" + minute : minute;
            let second = value % 60;
            second = second < 10 ? "0" + second : second;
            return hour + ":" + minute + ":" + second;
        },
    },
};
</script>
