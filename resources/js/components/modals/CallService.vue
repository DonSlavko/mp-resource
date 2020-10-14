<template>
  <v-dialog v-model="dialog" max-width="800px">
    <template v-slot:activator="{ on, attrs }">
      <a class="list-item"
         v-bind="attrs"
         v-on="on"
      >Rückrufservice
      </a>
    </template>
    <v-card>
      <v-card-title>
        <span class="headline">Rückrufservice</span>
      </v-card-title>

      <v-card-text>
        <v-container>
          <v-form ref="modal">
            <v-row>
              <v-col cols="12">
                <hr style="margin-bottom: 2rem">
                <p>Wir rufen Sie gerne zurück. Bitte geben Sie Ihre Kontaktinformation und einen Rückrufzeitraum an.</p>
              </v-col>
              <v-col cols="12">
                <v-row>
                  <v-col cols="3">
                    Name
                  </v-col>
                  <v-col cols="9" class="py-0">
                    <v-text-field
                        :rules="[value => !!value || '']"
                        :error="errors.name"
                        v-model="form.name"
                        class="mt-1"
                        label="Name"
                        id="name" name="name"
                        outlined dense></v-text-field>
                  </v-col>

                  <v-col cols="3">
                    Telefonnummer
                  </v-col>
                  <v-col cols="9" class="py-0">
                    <v-text-field
                        :rules="[value => !!value || '']"
                        :error="errors.telephone"
                        v-model="form.telephone"
                        class="mt-1"
                        label="Telefonnummer"
                        id="telephone" name="telephone"
                        outlined dense></v-text-field>
                  </v-col>

                  <v-col cols="3">
                    Email
                  </v-col>
                  <v-col cols="9" class="py-0">
                    <v-text-field
                        :rules="[value => !!value || '']"
                        :error="errors.email"
                        v-model="form.email"
                        class="mt-1"
                        label="Email"
                        id="email" name="email"
                        outlined dense></v-text-field>
                  </v-col>

                  <v-col cols="3">
                    Rückrufzeitraum
                  </v-col>
                  <v-col cols="9" class="py-0">
                    <v-text-field
                        :rules="[value => !!value || '']"
                        :error="errors.recall"
                        v-model="form.recall"
                        class="mt-1"
                        label="Rückrufzeitraum"
                        id="recall" name="recall"
                        outlined dense></v-text-field>
                  </v-col>

                  <v-col cols="3">
                    Nachricht
                  </v-col>
                  <v-col cols="9" class="py-0">
                    <v-textarea
                        :rules="[value => !!value]"
                        :error="errors.message"
                        v-model="form.message"
                        id="message" name="message"
                        label="Nachricht"
                        outlined dense></v-textarea>
                  </v-col>

                  <v-col cols="12">
                    Mit dem drücken des Senden Buttons haben Sie auch die <a href="/datenschutzerklaerung">Datenschutzerklärung</a>
                    zur Kenntnis genommen.
                  </v-col>

                  <v-col offset="8" cols="4" md="4">
                    <v-btn color="primary"
                           style="text-transform: none!important;"
                           @click="submit"
                           depressed large block>Senden
                    </v-btn>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
          </v-form>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "CallService",

  data() {
    return {
      dialog: false,

      form: {
        name: '',
        telephone: '',
        email: '',
        recall: '',
        message: '',
      },

      errors: {}
    }
  },

  methods: {
    close() {
      this.dialog = false
      this.form = {
        name: '',
        telephone: '',
        email: '',
        recall: '',
        message: '',
      }
    },

    submit() {
      console.log(this.$refs.modal.validate());
      if (this.$refs.modal.validate()) {
        axios.post('/back/call-service', this.form, {}).then((response) => {
          this.close();
          this.$toasted.show(response.data);
        }).catch((error) => {
          this.errors = error.response.data;
        });
      }
    },
  }
}
</script>

<style scoped>
.list-item {
  color: #878787;
  text-transform: capitalize;
}

.list-item:hover {
  font-style: underline;
}
</style>
