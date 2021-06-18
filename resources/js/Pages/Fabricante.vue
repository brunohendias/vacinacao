<template>
    <Layout>
        <h4>Cadastro</h4>
        <hr>
        <cadastro />
        <errors :errors="errors"/>
        <cabecalho :tot_registro="dados.length" />
        <listagem :dados="dados" />
    </Layout>
</template>

<script>
import Layout from '../Layout.vue'
import cadastro from '../components/cadastro/fabricante.vue'
import errors from '../components/shared/panel/error/cadastro.vue'
import cabecalho from '../components/shared/panel/listagem/cabecalho.vue'
import listagem from '../components/listagem/fabricante.vue'

export default {
    name: 'Fabricante',
    props: {
        dados: Array,
        errors: Object
    },
    components: {
        Layout,
        cadastro,
        errors,
        cabecalho,
        listagem
    }
}
</script>