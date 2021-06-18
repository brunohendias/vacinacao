<template>
    <table class="table table-sm table-bordered table-striped">
        <thead>
            <tr>
                <th v-for="(coluna, i) in colunas" :key="i" scope="col">
                    {{ coluna.title }} 
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(dado, i) in dados" :key="i">
                <th>{{ dado.paciente.nome }}</th>
                <th>{{ dado.vacina.nome }}</th>
                <th>{{ dado.id_dose }}</th>
                <th>{{ dado.dose_atual }}</th>
                <th>{{ formata.data(dado.data_vacinacao) }}</th>
                <th>{{ formata.data(dado.data_prox_vaci) }}</th>
                <th>
                    <button class="btn btn-primary btn-sm" :disabled="foraData(dado)" @click="revacinar(dado)">
                        Revacinar
                    </button>
                </th>
            </tr>
        </tbody>
    </table>
</template>

<script>
import { formata, data } from '../../core/helpers'

export default {
    name: 'historicoListagem',
    props: {
        dados: Array
    },
    data() {
        return {
            colunas: [
                { title: 'Paciente' },
                { title: 'Vacina' },
                { title: 'Identificação da dose' },
                { title: 'Dose atual' },
                { title: 'Data vacinação' },
                { title: 'Data proxima vacinação' },
                { title: 'Revacinar' }
            ],
            formata, data
        }
    },
    methods: {
        async revacinar(dado) {
            await this.$inertia.put('/historico/'+dado.id, dado);
        },
        foraData(dado) {
            return !(data.hoje() == dado.data_prox_vaci)
        }
    }
}
</script>