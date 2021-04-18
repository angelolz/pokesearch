$(function() {
    $("form[name='add-pokemon']").validate(
        {
            onkeyup: false,
            errorElement: "div",
            errorClass: "invalid",
            errorPlacement: function(error, element) {
                error.insertBefore("#addPokemonButton");
            },
            rules: {
                pokemon: {
                    required: true,
                    remote: {
                        url: "/private/functions/validLink.php",
                        type: "post",
                        data: {
                            name: function() {
                                return "https://pokeapi.co/api/v2/pokemon/" + $("input[name='pokemon']").val();
                            }
                        }
                    }
                },
                "move-1": {
                    require_from_group: [1, "input[name^='move']"],
                    remote: {
                        url: "/private/functions/validLink.php",
                        type: "post",
                        data: {
                            name: function() {
                                return "https://pokeapi.co/api/v2/move/" + $("input[name='move-1']").val();
                            }
                        }
                    }
                },
                "move-2": {
                    require_from_group: [1, "input[name^='move']"],
                    remote: {
                        url: "/private/functions/validLink.php",
                        type: "post",
                        data: {
                            name: function() {
                                return "https://pokeapi.co/api/v2/move/" + $("input[name='move-2']").val();
                            }
                        }
                    }
                },
                "move-3": {
                    require_from_group: [1, "input[name^='move']"],
                    remote: {
                        url: "/private/functions/validLink.php",
                        type: "post",
                        data: {
                            name: function() {
                                return "https://pokeapi.co/api/v2/move/" + $("input[name='move-3']").val();
                            }
                        }
                    }
                },
                "move-4": {
                    require_from_group: [1, "input[name^='move']"],
                    remote: {
                        url: "/private/functions/validLink.php",
                        type: "post",
                        data: {
                            name: function() {
                                return "https://pokeapi.co/api/v2/pokemon/" + $("input[name='move-4']").val();
                            }
                        }
                    }
                },
            },
            messages: {
                pokemon: {
                    required: "Pokémon name cannot be blank!",
                    remote: "That Pokémon is invalid!"
                },
                "move-1": {
                    require_from_group: "You must provide at least one move.",
                    remote: "Move 1 is not a valid move."
                },
                "move-2": {
                    require_from_group: "You must provide at least one move.",
                    remote: "Move 2 is not a valid move."
                },
                "move-3": {
                    require_from_group: "You must provide at least one move.",
                    remote: "Move 3 is not a valid move."
                },
                "move-4": {
                    require_from_group: "You must provide at least one move.",
                    remote: "Move 4 is not a valid move."
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        }
    );
});
