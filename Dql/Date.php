<?php
/**
 * Von https://github.com/beberlei/DoctrineExtensions
 */
namespace Baetmaen\DqlBundle\Dql;

/**
 * DoctrineExtensions Mysql Function Pack
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to kontakt@beberlei.de so I can send you a copy immediately.
 */

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;

/**
 * "DATE" "(" SimpleArithmeticExpression ")".
 * Modified from DoctrineExtensions\Query\Mysql\Year
 *
 * More info:
 * http://dev.mysql.com/doc/refman/5.5/en/date-and-time-functions.html#function_date
 *
 * @category    DoctrineExtensions
 * @package     DoctrineExtensions\Query\Mysql
 * @author      Dawid Nowak <macdada@mmg.pl>
 * @license     MIT License
 */
class Date extends FunctionNode
{
    public $date;

    /**
     * @override
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        return 'DATE('.$sqlWalker->walkArithmeticPrimary($this->date).')';
    }

    /**
     * @override
     */
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->date = $parser->ArithmeticPrimary();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}