<template>
  <v-container fluid>
      <v-row dense>
        <v-col>
          <v-card>
            <v-img
              class="white--text align-end"
              src="/images/site/welcome.svg"
              height="450px"
              contain
            />

            <v-card-title>
              Welcome to Soapbox
            </v-card-title>

            <v-card-subtitle>
              The best forum on the internet.
            </v-card-subtitle>

            <v-card-text>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Proin sagittis nisl rhoncus mattis rhoncus urna neque. In cursus turpis massa tincidunt dui ut ornare. Nam libero justo laoreet sit. Nibh praesent tristique magna sit. Amet massa vitae tortor condimentum lacinia quis. Mauris cursus mattis molestie a iaculis at erat pellentesque adipiscing. Placerat orci nulla pellentesque dignissim enim sit. Mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Convallis convallis tellus id interdum velit laoreet. Amet porttitor eget dolor morbi non arcu risus. Cras semper auctor neque vitae tempus quam. Eros in cursus turpis massa tincidunt dui ut ornare. Varius morbi enim nunc faucibus a. Et ligula ullamcorper malesuada proin libero nunc. Velit sed ullamcorper morbi tincidunt ornare massa eget egestas purus. Porta lorem mollis aliquam ut porttitor leo a. Massa eget egestas purus viverra accumsan in nisl. Tristique nulla aliquet enim tortor. Neque ornare aenean euismod elementum.
              </p>
              <p>
                Aliquet enim tortor at auctor urna nunc id. Quis hendrerit dolor magna eget. Lacus sed turpis tincidunt id aliquet. Aliquet sagittis id consectetur purus ut faucibus pulvinar elementum integer. Felis imperdiet proin fermentum leo vel orci porta non pulvinar. Scelerisque eleifend donec pretium vulputate sapien. Turpis massa tincidunt dui ut ornare lectus sit amet est. Donec et odio pellentesque diam volutpat. Eu turpis egestas pretium aenean. Duis ut diam quam nulla porttitor massa id. Sed elementum tempus egestas sed sed risus. Posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Gravida cum sociis natoque penatibus et magnis. Adipiscing tristique risus nec feugiat in fermentum posuere urna nec.
              </p>
            </v-card-text>

            <v-card-actions>
              <v-btn
                link
                to="/register"
                color="green"
              >
                Register Now
              </v-btn>

              <v-btn
                link
                to="/login"
                text
              >
                Login
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
  </v-container>
</template>

<script>
  export default {
    name: 'WelcomePage',
    data() {
      return {}
    },
  }
</script>