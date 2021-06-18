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
                <th>{{ dado.fabricante.nome }}</th>
                <th>{{ dado.lote }}</th>
                <th>{{ formata.data(dado.data_validade) }}</th>
                <th>{{ dado.qtd_recebida }}</th>
                <th>{{ dado.qtd_atual }}</th>
                <th>{{ dado.intervalo_min }} dias</th>
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
                { title: 'Nome'},
                { title: 'Fabricante' },
                { title: 'Lote' },
                { title: 'Data de validade' },
                { title: 'Quantidade recebida' },
                { title: 'Quantidade atual' },
                { title: 'Intervalo entre aplicações' }
            ],
            formata
        }
    }
}
</script>