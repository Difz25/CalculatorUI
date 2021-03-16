<?php

namespace NaufalBlazeYT\CalculatorUI;

use jojoe77777\FormAPI\{CustomForm, SimpleForm};
use pocketmine\command\{Command, CommandSender};
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener
{
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool
	{
		if ($sender instanceof Player) {
			$this->calculatorUI($sender);
			return true;
		}
		$sender->sendMessage("§cUse this command in-game!");
		return false;
	}

	public function calculatorUI(Player $player): void
	{
		$form = new SimpleForm(function (Player $player, int $data = null) {
			if ($data === 1) $this->addition($player);
			elseif ($data === 2) $this->subtraction($player);
			elseif ($data === 3) $this->multiplication($player);
			elseif ($data === 4) $this->division($player);
		});
		$form->setTitle("§e§lCalculatorUI");
		$form->addButton("§cExit\n§fTap to close");
		$form->addButton("§f(§a+§f) §bAddition\n§fTap to open");
		$form->addButton("§f(§a-§f) §bSubtraction\n§fTap to open");
		$form->addButton("§f(§a×§f) §bMultiplication\n§fTap to open");
		$form->addButton("§f(§a÷§f) §bDivision\n§fTap to open");
		$player->sendForm($form);
	}

	public function addition(Player $player): void
	{
		$form = new CustomForm(function (Player $player, $data) {
			if (is_array($data) and is_numeric($data[1]) and is_numeric($data[2])) {
				$result = $data[1] + $data[2];
				$player->sendMessage("§aResult§f: §b" . number_format($result, 2));
				return;
			} elseif (!is_null($data)) $this->calculatorUI($player);
		});
		$form->setTitle("§f(§a+§f) §bAddition");
		$form->addLabel("§eWrite down the numbers to sum:");
		$form->addInput("");
		$form->addInput("+");
		$player->sendForm($form);
	}

	public function subtraction(Player $player): void
	{
		$form = new CustomForm(function (Player $player, $data) {
			if (is_array($data) and is_numeric($data[1]) and is_numeric($data[2])) {
				$result = $data[1] - $data[2];
				$player->sendMessage("§aResult§f: §b" . number_format($result, 2));
				return;
			} elseif (!is_null($data)) $this->calculatorUI($player);
		});
		$form->setTitle("§f(§a-§f) §bSubtraction");
		$form->addLabel("§eWrite down the numbers to sum:");
		$form->addInput("");
		$form->addInput("-");
		$player->sendForm($form);
	}

	public function multiplication(Player $player): void
	{
		$form = new CustomForm(function (Player $player, $data) {
			if (is_array($data) and is_numeric($data[1]) and is_numeric($data[2])) {
				$result = $data[1] * $data[2];
				$player->sendMessage("§aResult§f: §b" . number_format($result, 2));
				return;
			} elseif (!is_null($data)) $this->calculatorUI($player);
		});
		$form->setTitle("§f(§a×§f) §bMultiplication");
		$form->addLabel("§eWrite down the numbers to sum:");
		$form->addInput("");
		$form->addInput("×");
		$player->sendForm($form);
	}

	public function division(Player $player): void
	{
		$form = new CustomForm(function (Player $player, $data) {
			if (is_array($data) and is_numeric($data[1]) and is_numeric($data[2])) {
				$result = $data[1] / $data[2];
				$player->sendMessage("§aResult§f: §b" . number_format($result, 2));
				return;
			} elseif (!is_null($data)) $this->calculatorUI($player);
		});
		$form->setTitle("§f(§a÷§f) §bDivision");
		$form->addLabel("§eWrite down the numbers to sum:");
		$form->addInput("");
		$form->addInput("÷");
		$player->sendForm($form);
	}
}