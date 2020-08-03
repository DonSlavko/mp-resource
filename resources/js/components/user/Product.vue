<template>
  <v-container>
    <v-row>
      <v-col cols="12" sm="6" md="5">
        <v-carousel hide-delimiters>
          <v-carousel-item
              v-for="(item,i) in items"
              :key="i"
              :src="item.src"
          ></v-carousel-item>
        </v-carousel>
      </v-col>

      <v-col cols="12" sm="6" md="7">
        <h2 class="text-h6 mb-3" style="text-transform: uppercase">Product Details</h2>
        <hr style="background: #efefef; color: rgba(68,68,68,1); height: 1px; width: 80%; border: none;">

        <p>Wir werden unmittelbar vor dem Eintreffen der Arznei bzw. vor Beginn des
          Vorbestellungsprozesses, den Produktnamen inkl. Beschreibung veröffentlichen und Sie zeitnah über
          unseren Newsletter benachrichtigen. Wir werden hier später das Wirkungsprofil einer gleichermaßen THC
          und CBD-haltigen Cannabiskreuzung darstellen.</p>

        <p>Das Wirkungsprofil richtet sich auf das Beruhigen der körperlichen Symptome wie z.B.
          Muskelpasmen und Parkinson. CBD verstärkt zudem die schmerzstillenden Eigenschaften von THC.</p>

        <p>Diese Cannabiskreuzungen werden deshalb von den Patienten für einen symptomlosen
          Start am Morgen angewendet.</p>

        <b>Importeur:</b> Medical Pharma Resource GmbH <br>
          <b>Hersteller:</b> #### #### <br>
          <b>Darreichungsform:</b> Cannabisblüten <br>
        <b>Genetik:</b> Indica Dominant Hybrid (Siehe Arzneibroschüre) <br>
        <b>Wirkstoffe:</b> 1:1 THC zu CBD-Anteile <br>
        <b>PZN:</b>   5g ######## <br>
        <b>PZN:</b> 15g ######## <br>
      </v-col>




      <v-col cols="12">
        <template>
          <div class="text-center">
            Arzneibroschüre
            <v-btn class="ma-2" outlined color="primary">Download</v-btn>
            Chargenanalyse
            <v-btn class="ma-2" outlined color="primary">Download</v-btn>
          </div>
        </template>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  name: "Product",

  props: {
    item_id: null
  },

  data () {
    return {
      items: [
        {
          src: '/storage/Fortis-6-500x601.png',
        },
        {
          src: '/storage/MPR-Canna-Fortis-5-Gramm-500x601.png',
        },
        {
          src: '/storage/Sedation2-500x601.png',
        },
        {
          src: '/storage/Vesper-7-500x601.png',
        },
      ],
    }
  },
}
</script>
