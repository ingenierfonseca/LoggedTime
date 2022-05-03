<template>
    <div class="container">
        <h4>Detalle de sessiones de usuario</h4>
        <br/>
        <br/>
        <br/>

        <input type="text" v-model="nameFilter">
        <input type="date" v-model="dayFilter"
            value="2022-05-02"
            min="2000-01-01" max="2022-12-31" @change="getReportSession">
        <input type="button" value="buscar" @click="getReportSession">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Tiempo en session</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in report" :key="item.id">
                    <td>
                        {{ item.name }}
                    </td>
                    <td>
                        {{ item.email }}
                    </td>
                    <td>
                        {{item.session_time}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                report: [],
                nameFilter: '',
                dayFilter: new Date().toISOString().slice(0, 10)
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.getReportSession();
        },
        methods: {
            getReportSession() {
                this.loading = true;
                return window.axios.get('/api/loggedtime?date=' + this.dayFilter + '&name=' + this.nameFilter)
                    .then(res => {
                        this.report = res.data.data;
                    })
                    .catch(error => {
                        if(error.response)
                            this.alertError(error.response.data.message);
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            }
        }
    }
</script>