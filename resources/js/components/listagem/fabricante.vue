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
                <th>{{ dado.nome }}</th>
                <th>{{ formata.cnpj(dado.cnpj) }}</th>
                <th>{{ dado.qtd_dose_disponivel }}</th>
            </tr>
        </tbody>
    </table>
</template>

<script>
import { formata } from '../../core/helpers';

export default {
    name: 'fabricanteListagem',
    props: {
        dados: Array
    },
    data() {
        return {
            colunas: [
                { title: 'Nome' },
                { title: 'CNPJ' },
                { title: 'Quantidade de vacinas disponiveis' }
            ],
            formata
        }
    }
}
</script>