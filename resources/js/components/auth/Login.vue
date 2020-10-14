<template>
  <v-container fluid>
    <v-row>
      <v-col offset-md="5" cols="12" md="2">
        <v-img max-width="200" src="/storage/Logo-Original.png" contain></v-img>
      </v-col>
      <v-col offset-md="4" cols="12" md="4">
        <v-form method="POST" action="login" ref="form">
          <v-row>
            <v-col cols="12" class="py-0">
              <v-text-field
                  :error="errors.email"
                  :error-messages="errors.email"
                  v-model="form.email"
                  :rules="rules.email"
                  class="mt-1"
                  label="Benutzername oder E-Mail"
                  id="email"
                  name="email"
                  outlined
                  dense
              ></v-text-field>
            </v-col>

            <v-col cols="12" class="py-0">
              <label class="font-weight-bold text-subtitle-1"></label>
              <v-text-field
                  :error="errors.password"
                  :error-messages="errors.password"
                  v-model="form.password"
                  :rules="rules.password"
                  class="mt-1"
                  label="Passwort"
                  id="password"
                  name="password"
                  type="password"
                  outlined
                  dense
              ></v-text-field>
            </v-col>

            <v-col cols="12" class="py-0">
              <v-checkbox
                  v-model="form.remember"
                  name="remember"
                  label="Angemeldet bleiben"
              ></v-checkbox>
            </v-col>

            <v-col cols="12" md="6">
              <v-btn
                  color="primary"
                  style="text-transform: none !important"
                  @click="submit"
                  depressed
                  large
                  block
              >Anmelden
              </v-btn>
            </v-col>

            <v-col cols="12" md="6">
              <v-btn
                  href="/register"
                  color="secondary"
                  class="text--secondary"
                  style="text-transform: none !important"
                  large
                  block
              >Registrieren
              </v-btn>
            </v-col>

            <v-col cols="12">
              <v-btn
                  href="/password/reset"
                  class="text--secondary"
                  style="text-transform: none !important"
                  outlined
                  text
                  block
              >Haben Sie Ihr Passwort vergessen?
              </v-btn>
            </v-col>

            <v-col cols="12" class="text-center"> oder</v-col>

            <v-col cols="12">
              <v-btn
                  color="primary"
                  style="text-transform: none !important"
                  depressed
                  large
                  block
              >DocCheck Login
              </v-btn>
            </v-col>
          </v-row>
        </v-form>
      </v-col>

      <v-col offset-md="3" cols="12" md="6">
        <v-row>
          <v-col offset-md="1" cols="3">
            <v-btn
                href="datenschutzerklaerung"
                text
                class="text--secondary"
                style="text-transform: none !important"
            >
              Datenschutzerklärung
            </v-btn>
          </v-col>
          <v-col cols="12" md="4" class="text-center">
            <v-btn
                href="agb"
                text
                class="text--secondary"
                style="text-transform: none !important"
            >
              AGB
            </v-btn>
          </v-col>
          <v-col cols="12" md="4">
            <v-btn
                href="impressum"
                text
                class="text--secondary"
                style="text-transform: none !important"
            >
              Impressum
            </v-btn>
          </v-col>
        </v-row>
      </v-col>

      <v-col cols="12" class="text-center pt-10" style="color: #494949">
        Copyright © 2019-2020, Medical Pharma Resource GmbH
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "login",

  data() {
    return {
      rules: {
        email: [
          (value) =>
              !!value || "Gebe deinen Benutzernamen und deine E-Mail-Adresse ein",
        ],
        password: [(value) => !!value || "Bitte gib dein Passwort ein"],
      },

      errors: {},

      form: {
        email: null,
        password: null,
        remember: null,
      },
    };
  },

  methods: {
    submit() {
      if (this.$refs.form.validate()) {
        axios
            .post("/login", this.form)
            .then((response) => {
              window.location = "/neuigkeiten";
            })
            .catch((error) => {
              let errors = error.response.data.errors;
              this.errors = {
                password: errors.password
                    ? "Passwort ist nicht korrekt. Bitte versuchen Sie es erneut."
                    : null,
                email: errors.email
                    ? "Unbekannter Benutzername. Überprüfe ihn noch einmal oder versuche es mit deiner E-Mail-Adresse."
                    : null,
              };
            });
      }
    },
  },
};
</script>

<style scoped>
</style>
