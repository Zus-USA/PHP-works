<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* task/add.html.twig */
class __TwigTemplate_2e223b7a7f91a15747b0d181ef83e5af extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "task/add.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "task/add.html.twig"));

        $this->parent = $this->load("base.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Добавить";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "<div class=\"container\">
    <header class=\"header\">
        <h1 class=\"header__title\">Добавить</h1>
    </header>

    <main class=\"main\">
        ";
        // line 12
        if ((($tmp =  !Twig\Extension\CoreExtension::testEmpty((isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 12, $this->source); })()))) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 13
            yield "            <div class=\"alert alert--error\">
                <span class=\"alert__icon\">✗</span>
                <div>
                    ";
            // line 16
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 16, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["fieldErrors"]) {
                // line 17
                yield "                        ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable($context["fieldErrors"]);
                foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                    // line 18
                    yield "                            <div>";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["error"], "html", null, true);
                    yield "</div>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 20
                yield "                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['fieldErrors'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 21
            yield "                </div>
            </div>
        ";
        }
        // line 24
        yield "
        <form method=\"POST\" action=\"";
        // line 25
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_add");
        yield "\" class=\"form\">
            <div class=\"form__group\">
                <label for=\"title\" class=\"form__label\">
                    Название
                    <span class=\"form__required\">*</span>
                </label>
                <input 
                    type=\"text\" 
                    id=\"title\" 
                    name=\"title\" 
                    class=\"form__input ";
        // line 35
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "title", [], "any", true, true, false, 35)) {
            yield "form__input--error";
        }
        yield "\"
                    required 
                    minlength=\"3\"
                    maxlength=\"255\"
                    placeholder=\"\"
                    value=\"";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(((CoreExtension::getAttribute($this->env, $this->source, ($context["old"] ?? null), "title", [], "any", true, true, false, 40)) ? (Twig\Extension\CoreExtension::default(CoreExtension::getAttribute($this->env, $this->source, (isset($context["old"]) || array_key_exists("old", $context) ? $context["old"] : (function () { throw new RuntimeError('Variable "old" does not exist.', 40, $this->source); })()), "title", [], "any", false, false, false, 40), "")) : ("")), "html", null, true);
        yield "\"
                    autofocus
                >
                ";
        // line 43
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["errors"] ?? null), "title", [], "any", true, true, false, 43)) {
            // line 44
            yield "                    <div class=\"form__error\">
                        ";
            // line 45
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["errors"]) || array_key_exists("errors", $context) ? $context["errors"] : (function () { throw new RuntimeError('Variable "errors" does not exist.', 45, $this->source); })()), "title", [], "any", false, false, false, 45));
            foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                // line 46
                yield "                            <div class=\"form__error-text\">";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["error"], "html", null, true);
                yield "</div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['error'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 48
            yield "                    </div>
                ";
        }
        // line 50
        yield "                <div class=\"form__hint\">3-255 символов</div>
            </div>
            
            <div class=\"form__actions\">
                <button type=\"submit\" class=\"btn btn--primary btn--large\">Сохранить</button>
                <a href=\"";
        // line 55
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_list");
        yield "\" class=\"btn btn--secondary btn--large\">Отмена</a>
            </div>
        </form>
    </main>

    <footer class=\"footer\">
        <a href=\"";
        // line 61
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_list");
        yield "\" class=\"footer__link\">← Назад</a>
    </footer>
</div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "task/add.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  214 => 61,  205 => 55,  198 => 50,  194 => 48,  185 => 46,  181 => 45,  178 => 44,  176 => 43,  170 => 40,  160 => 35,  147 => 25,  144 => 24,  139 => 21,  133 => 20,  124 => 18,  119 => 17,  115 => 16,  110 => 13,  108 => 12,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Добавить{% endblock %}

{% block body %}
<div class=\"container\">
    <header class=\"header\">
        <h1 class=\"header__title\">Добавить</h1>
    </header>

    <main class=\"main\">
        {% if errors is not empty %}
            <div class=\"alert alert--error\">
                <span class=\"alert__icon\">✗</span>
                <div>
                    {% for fieldErrors in errors %}
                        {% for error in fieldErrors %}
                            <div>{{ error }}</div>
                        {% endfor %}
                    {% endfor %}
                </div>
            </div>
        {% endif %}

        <form method=\"POST\" action=\"{{ path('task_add') }}\" class=\"form\">
            <div class=\"form__group\">
                <label for=\"title\" class=\"form__label\">
                    Название
                    <span class=\"form__required\">*</span>
                </label>
                <input 
                    type=\"text\" 
                    id=\"title\" 
                    name=\"title\" 
                    class=\"form__input {% if errors.title is defined %}form__input--error{% endif %}\"
                    required 
                    minlength=\"3\"
                    maxlength=\"255\"
                    placeholder=\"\"
                    value=\"{{ old.title|default('') }}\"
                    autofocus
                >
                {% if errors.title is defined %}
                    <div class=\"form__error\">
                        {% for error in errors.title %}
                            <div class=\"form__error-text\">{{ error }}</div>
                        {% endfor %}
                    </div>
                {% endif %}
                <div class=\"form__hint\">3-255 символов</div>
            </div>
            
            <div class=\"form__actions\">
                <button type=\"submit\" class=\"btn btn--primary btn--large\">Сохранить</button>
                <a href=\"{{ path('task_list') }}\" class=\"btn btn--secondary btn--large\">Отмена</a>
            </div>
        </form>
    </main>

    <footer class=\"footer\">
        <a href=\"{{ path('task_list') }}\" class=\"footer__link\">← Назад</a>
    </footer>
</div>
{% endblock %}
", "task/add.html.twig", "C:\\Users\\Приятный\\Desktop\\project\\unik\\web\\PHP-works\\web-shooter-5\\templates\\task\\add.html.twig");
    }
}
