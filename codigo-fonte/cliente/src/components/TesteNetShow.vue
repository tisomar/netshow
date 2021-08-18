<template>
  <v-container>
  <v-form  fill-height fluid style="margin: 0px; padding: 0px; width: 50%"
      ref="form"
      v-model="valido"
      lazy-validation
      align="center"
      justify="center"
  >
    <v-text-field
        v-model="nome"
        :counter="100"
        :rules="nomeRules"
        label="Nome"
        required
    ></v-text-field>

    <v-text-field
        v-model="email"
        :rules="emailRules"
        label="E-mail"
        required
    ></v-text-field>
    <v-row>
      <v-col cols="6">
        <vue-tel-input-vuetify
            :preferred-countries="['id', 'gb', 'ua']"
            :valid-characters-only="true"
            @input="onInput"
            :rules="phoneRules"
            placeholder="Telefone"
        />
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="6">
        <div v-if="phone.number" style="color: black">
          <span>

            <div v-if="!phone.valid" style="color: red">
              <strong>Telefone não é válido</strong>
            </div>
          </span>
        </div>
      </v-col>
    </v-row>

    <v-textarea
        v-model="mensagem"
        :rules="mensagemRules"
        :counter="100"
        label="Mensagem"
        required
    ></v-textarea>

    <v-file-input
        v-model="arquivo"
        show-size
        :rules="arquivoRules"
        accept=".doc, .docx, .pdf, .odt, .txt"
        placeholder="Selecione o arquivo"
        prepend-icon="mdi-file"
        label="Arquivo"
    ></v-file-input>
    <v-btn
        :disabled="!valido"
        color="success"
        class="mr-4"
        @click="validate"
    >
      Enviar
    </v-btn>
    <v-btn
        color="error"
        class="mr-4"
        @click="reset"
    >
      Limpar
    </v-btn>
    <v-btn
        color="warning"
        @click="resetValidation"
    >
      Limpar Validação
    </v-btn>
  </v-form>

    <v-dialog
        v-model="dialog"
        width="500"
        ref="dialog"
    >
      <v-card>
        <v-card-title class="text-h5 grey lighten-2">
           Teste Netshow
        </v-card-title>

        <v-card-text>
          Cadastrado com Sucesso!
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
              color="primary"
              text
              @click="dialog = false"
          >
            OK
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

  </v-container>
</template>


<script>

import axios from 'axios';

export default {
  data: () => ({
    valido: true,
    telefoneBool: false,
    nome: '',
    data: null,
    arquivo: null,
    response: null,
    ip: null,
    useragent: null,
    ts: null,
    dialog: false,
    nomeRules: [
      v => !!v || 'Nome é obrigatório',
      v => (v && v.length <= 100) || 'Nome deve ser menor que 100 caracteres',
    ],
    email: '',
    emailRules: [
      v => !!v || 'E-mail é obrigatório',
      v => /.+@.+\..+/.test(v) || 'E-mail deve ser válido',
    ],
    phone: {
      number: "",
      valid: false,
      country: undefined
    },
    phoneRules: [
      v => !!v || 'Telefone é obrigatório',
    ],
    mensagem: '',
    mensagemRules: [
      v => !!v || 'Mensagem é obrigatório',
      v => (v && v.length <= 100) || 'Mensagem deve ser menor que 100 caracteres',
    ],
    arquivoRules: [
      v => !!v || 'Arquivo é obrigatório',
      value => !value || value.size < 5000 || 'Arquivo deve ser menor que 5 KB!',
    ],
  }),
  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        if (this.telefoneBool) {

          let formData = new FormData();
          formData.append('nome', this.nome);
          formData.append('email', this.email);
          formData.append('telefone', this.phone.number);
          formData.append('mensagem', this.mensagem);
          formData.append('arquivo', this.arquivo);
          formData.append('ip', this.ip);
          var vm = this;
          axios.post('http://localhost:8080/api/contato',
              formData,
              {
                headers: {
                  'Content-Type': 'multipart/form-data'
                }
              }
          ).then(function (data) {
            console.log(data.data);

            vm.dialog = true;

          })
              .catch(function () {
                console.log('FALHA!!');
              });
          // this.dialog = true;
        }
      }
    },
    reset() {
      this.$refs.form.reset()
    },
    resetValidation() {
      this.$refs.form.resetValidation()
    },
    onInput(formattedNumber, {number, valid, country}) {
      this.phone.number = number.international;
      this.phone.valid = valid;
      this.telefoneBool = valid;
      this.phone.country = country && country.name;
    }
  },
  watch: {
    // This should do a substring of the result returned by CloudFlare
    response: function (){
      this.ip = this.response.substring(this.response.search('ip=')+3, this.response.search('ts='));
      this.ts = this.response.substring(this.response.search('ts=')+3, this.response.search('visit_scheme='));
      this.useragent = this.response.substring(this.response.search('uag=')+4, this.response.search('colo='));
    }
  },
  computed: {
    tsFormatted () {
      return new Date(this.ts * 1000)
    }
  },
  mounted() {
    // Get the user's states from the cloudflare service
    axios
        .get("https://www.cloudflare.com/cdn-cgi/trace")
        .then(response=> (this.response = response.data))
  }
}
</script>
