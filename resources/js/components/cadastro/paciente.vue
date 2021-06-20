<template>
    <form class="form">
        <div class="row">
            <div class="col-sm-3">
                <label for="nome">Nome: </label>
                <input class="form-control" type="text" name="nome" v-model="body.nome" required
                    placeholder="Nome completo do paciente" />
            </div>
            <div class="col-sm-2">
                <label for="cpf">CPF: </label>
                <the-mask class="form-control" type="text" name="cpf" v-model="body.cpf" required 
                    :mask="cpf" :masked="false" placeholder="000.000.000-00" />
            </div>
            <div class="col-sm-2">
                <label for="rg">RG: </label>
                <the-mask class="form-control" type="text" name="rg" v-model="body.rg" required 
                    :mask="rg" :masked="false" placeholder="00.000.000-0" />
            </div>
            <div class="col-sm-3">
                <label for="telefone">Telefone: </label>
                <the-mask class="form-control" type="text" name="telefone" v-model="body.telefone" required 
                    :mask="telefone" :masked="false" placeholder="(00) 00000-0000" />
            </div>
            <cadastro :body="body" :disable="disable" :web="web"/>
        </div>
    </form>
</template>

<script>
import cadastro from '../botao/cadastro.vue'
import { cpf, rg, telefone } from '../../core/masks'

export default {
    name: 'fabricanteCadastro',
    components: {
        cadastro
    },
    data() {
        return {
            cpf,rg,telefone,
            body: {
                nome: null,
                cpf: null,
                rg: null,
                telefone: null
            },
            web: '/paciente'
        }
    },
    computed: {
        disable() {
            return !this.body.nome  || !this.body.cpf || !this.body.rg 
                || !this.body.telefone || this.body.cpf.length < 11 
                || this.body.rg.length < 9 || this.body.telefone.length < 11
        }
    }
}
</script>