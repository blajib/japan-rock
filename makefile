install: ## Initialize the project
	symfony composer-install
	symfony console do:mi:mi
	symfony console do:fix:load
	@$(call GREEN, "Project initialized!")
	