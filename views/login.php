<?php
session_start();
if($_SESSION['my_token'] == '' || $_SESSION['cookie'] == ''){
    header('Location: /index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/vuetify@1.x/dist/vuetify.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body>
  <div id="app">
    <v-app>
      <v-content>
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4>
                    <v-card class="elevation-12">
                        <v-toolbar dark color="primary">
                        <v-toolbar-title>Login</v-toolbar-title>
                        </v-toolbar>
                        <v-form action="/index.php" method="post">
                            <v-card-text>

                            <input type="hidden" name="token" value="<?php echo $_SESSION['my_token'];  ?>">
                            <input type="hidden" name="cookie" value="<?php echo $_SESSION['cookie'];  ?>">
                            <v-text-field prepend-icon="person" name="user" label="Login" type="text" v-model="user"></v-text-field>
                            <v-text-field id="password" prepend-icon="lock" name="pass" label="Password" type="password" v-model="password"></v-text-field>

                            </v-card-text>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn type="submit" color="primary">Login</v-btn>
                            </v-card-actions>
                        </v-form>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
      </v-content>
    </v-app>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@1.x/dist/vuetify.js"></script>
  <script src="js/app.js">
  </script>
</body>
</html>

