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

/* task/list.html.twig */
class __TwigTemplate_e370aec3192ea25599ba833e86526605 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "task/list.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "task/list.html.twig"));

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

        yield "Задачи";
        
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
        <h1 class=\"header__title\">Задачи</h1>
    </header>

    <main class=\"main\">
        ";
        // line 12
        if ((($tmp = (isset($context["success"]) || array_key_exists("success", $context) ? $context["success"] : (function () { throw new RuntimeError('Variable "success" does not exist.', 12, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 13
            yield "            <div class=\"alert alert--success\">
                <span class=\"alert__icon\">✓</span>
                ";
            // line 15
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["success"]) || array_key_exists("success", $context) ? $context["success"] : (function () { throw new RuntimeError('Variable "success" does not exist.', 15, $this->source); })()), "html", null, true);
            yield "
            </div>
        ";
        }
        // line 18
        yield "        
        ";
        // line 19
        if ((($tmp = (isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 19, $this->source); })())) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 20
            yield "            <div class=\"alert alert--error\">
                <span class=\"alert__icon\">✗</span>
                ";
            // line 22
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["error"]) || array_key_exists("error", $context) ? $context["error"] : (function () { throw new RuntimeError('Variable "error" does not exist.', 22, $this->source); })()), "html", null, true);
            yield "
            </div>
        ";
        }
        // line 25
        yield "
        <div class=\"actions\">
            <a href=\"";
        // line 27
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_add");
        yield "\" class=\"btn btn--primary\">Добавить</a>
        </div>

        ";
        // line 30
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["tasks"]) || array_key_exists("tasks", $context) ? $context["tasks"] : (function () { throw new RuntimeError('Variable "tasks" does not exist.', 30, $this->source); })())) == 0)) {
            // line 31
            yield "            <div class=\"empty-state\">
                <div class=\"empty-state__icon\">—</div>
                <h2 class=\"empty-state__title\">Нет задач</h2>
                <p class=\"empty-state__text\">Добавьте первую задачу</p>
                <a href=\"";
            // line 35
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("task_add");
            yield "\" class=\"btn btn--primary\">Добавить</a>
            </div>
        ";
        } else {
            // line 38
            yield "            <div class=\"tasks\">
                <div class=\"tasks__header\">
                    <div class=\"tasks__title\">";
            // line 40
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["tasks"]) || array_key_exists("tasks", $context) ? $context["tasks"] : (function () { throw new RuntimeError('Variable "tasks" does not exist.', 40, $this->source); })())), "html", null, true);
            yield " задач</div>
                </div>
                <ul class=\"task-list\">
                    ";
            // line 43
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["tasks"]) || array_key_exists("tasks", $context) ? $context["tasks"] : (function () { throw new RuntimeError('Variable "tasks" does not exist.', 43, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["task"]) {
                // line 44
                yield "                        <li class=\"task-item ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["task"], "isCompleted", [], "any", false, false, false, 44)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    yield "task-item--completed";
                }
                yield "\">
                            <div class=\"task-item__status\">
                                ";
                // line 46
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["task"], "isCompleted", [], "any", false, false, false, 46)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 47
                    yield "                                    <span class=\"status-icon status-icon--completed\">■</span>
                                ";
                } else {
                    // line 49
                    yield "                                    <span class=\"status-icon status-icon--pending\">□</span>
                                ";
                }
                // line 51
                yield "                            </div>
                            <div class=\"task-item__content\">
                                <div class=\"task-item__title\">";
                // line 53
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["task"], "title", [], "any", false, false, false, 53), "html", null, true);
                yield "</div>
                                ";
                // line 54
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, $context["task"], "createdAt", [], "any", false, false, false, 54)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 55
                    yield "                                    <div class=\"task-item__meta\">";
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["task"], "getFormattedCreatedAt", [], "method", false, false, false, 55), "html", null, true);
                    yield "</div>
                                ";
                }
                // line 57
                yield "                            </div>
                        </li>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['task'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 60
            yield "                </ul>
            </div>
        ";
        }
        // line 63
        yield "    </main>

    <footer class=\"footer\">
        <p class=\"footer__text\">";
        // line 66
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield "</p>
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
        return "task/list.html.twig";
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
        return array (  225 => 66,  220 => 63,  215 => 60,  207 => 57,  201 => 55,  199 => 54,  195 => 53,  191 => 51,  187 => 49,  183 => 47,  181 => 46,  173 => 44,  169 => 43,  163 => 40,  159 => 38,  153 => 35,  147 => 31,  145 => 30,  139 => 27,  135 => 25,  129 => 22,  125 => 20,  123 => 19,  120 => 18,  114 => 15,  110 => 13,  108 => 12,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Задачи{% endblock %}

{% block body %}
<div class=\"container\">
    <header class=\"header\">
        <h1 class=\"header__title\">Задачи</h1>
    </header>

    <main class=\"main\">
        {% if success %}
            <div class=\"alert alert--success\">
                <span class=\"alert__icon\">✓</span>
                {{ success }}
            </div>
        {% endif %}
        
        {% if error %}
            <div class=\"alert alert--error\">
                <span class=\"alert__icon\">✗</span>
                {{ error }}
            </div>
        {% endif %}

        <div class=\"actions\">
            <a href=\"{{ path('task_add') }}\" class=\"btn btn--primary\">Добавить</a>
        </div>

        {% if tasks|length == 0 %}
            <div class=\"empty-state\">
                <div class=\"empty-state__icon\">—</div>
                <h2 class=\"empty-state__title\">Нет задач</h2>
                <p class=\"empty-state__text\">Добавьте первую задачу</p>
                <a href=\"{{ path('task_add') }}\" class=\"btn btn--primary\">Добавить</a>
            </div>
        {% else %}
            <div class=\"tasks\">
                <div class=\"tasks__header\">
                    <div class=\"tasks__title\">{{ tasks|length }} задач</div>
                </div>
                <ul class=\"task-list\">
                    {% for task in tasks %}
                        <li class=\"task-item {% if task.isCompleted %}task-item--completed{% endif %}\">
                            <div class=\"task-item__status\">
                                {% if task.isCompleted %}
                                    <span class=\"status-icon status-icon--completed\">■</span>
                                {% else %}
                                    <span class=\"status-icon status-icon--pending\">□</span>
                                {% endif %}
                            </div>
                            <div class=\"task-item__content\">
                                <div class=\"task-item__title\">{{ task.title }}</div>
                                {% if task.createdAt %}
                                    <div class=\"task-item__meta\">{{ task.getFormattedCreatedAt() }}</div>
                                {% endif %}
                            </div>
                        </li>
                    {% endfor %}
                </ul>
            </div>
        {% endif %}
    </main>

    <footer class=\"footer\">
        <p class=\"footer__text\">{{ 'now'|date('Y') }}</p>
    </footer>
</div>
{% endblock %}
", "task/list.html.twig", "C:\\Users\\Приятный\\Desktop\\project\\unik\\web\\PHP-works\\web-shooter-5\\templates\\task\\list.html.twig");
    }
}
