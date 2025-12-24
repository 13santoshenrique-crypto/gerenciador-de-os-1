
# Blueprint do Projeto: Sistema de Gestão de Manutenção

## Visão Geral

Este projeto é um sistema de gestão de ordens de serviço e equipamentos, projetado para otimizar o controle e o acompanhamento de manutenções. A aplicação oferece uma interface moderna, intuitiva e responsiva, com dashboards detalhados para análise de dados e tomada de decisão.

## Funcionalidades e Design Implementados

### v1.0: Estrutura Inicial e CRUDs

*   **Autenticação:** Sistema completo de login, registro e recuperação de senha (padrão Laravel Breeze).
*   **CRUD de Ordens de Serviço:**
    *   Modelo, Migração e Controller para `ServiceOrder`.
    *   Relacionamento `belongsTo` com o modelo `User`.
*   **CRUD de Equipamentos:**
    *   Modelo, Migração e Controller para `Equipment`.
    *   Relacionamento `hasMany` com `ServiceOrder`.
    *   Telas de listagem, criação, edição, visualização e exclusão.
*   **Roteamento:** Rotas de recurso para `service-orders` e `equipments`.
*   **Navegação:** Links para as seções de Ordens de Serviço e Equipamentos no menu principal.

---

## Plano de Ação Atual: A Revolução da Interface

O objetivo desta fase é transformar a aplicação em uma ferramenta com design de alto padrão e funcionalidades analíticas avançadas, focando em uma experiência de usuário excepcional.

### 1. Fundação do Design (Concluído)

*   **Paleta de Cores:** Definida uma paleta de cores moderna e corporativa (azul primário, tons de cinza, cores de status).
*   **Tipografia:** Padronizada a fonte "Poppins" para uma leitura clara e hierarquia visual.
*   **Estilos Globais:** Criadas classes CSS customizadas para componentes (cards, botões, tabelas) e aplicadas no layout principal (`app.blade.php`).
*   **Dependências:** Instalada a biblioteca `Chart.js` para visualização de dados.

### 2. Dashboard de KPIs

*   **Objetivo:** Criar um dashboard central que ofereça uma visão geral e analítica da operação.
*   **Ações:**
    *   [ ] Redesenhar a tela `dashboard.blade.php`.
    *   [ ] Adicionar "cards" para exibir KPIs (Total de OS, OS Pendentes, Total de Equipamentos, etc.).
    *   [ ] Implementar gráficos dinâmicos (Chart.js) para "OS por Status" e "Novas OS por Período".
    *   [ ] Criar filtros para o dashboard (por data, status, etc.).
    *   [ ] Atualizar o Controller para fornecer os dados necessários ao dashboard.

### 3. Modernização das Telas CRUD

*   **Objetivo:** Alinhar todas as telas do sistema com a nova identidade visual.
*   **Ações:**
    *   [ ] Redesenhar a tela de listagem de Equipamentos (`equipments/index.blade.php`) usando o componente `card` e a nova tabela.
    *   [ ] Redesenhar os formulários de criação/edição de Equipamentos (`equipments/create.blade.php`, `equipments/edit.blade.php`) com o novo design.
    *   [ ] Repetir o processo para todas as telas de Ordens de Serviço.

